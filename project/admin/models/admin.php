<?php 
class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get admin dashboard analytics
    public function getDashboardAnalytics($days = 30) {
        try {
            $analytics = [];

            // Recipe submission trends
            $trend_query = "SELECT 
                              DATE(created_at) as date,
                              COUNT(*) as submissions,
                              COUNT(CASE WHEN status = 'verified' THEN 1 END) as verified,
                              COUNT(CASE WHEN status = 'rejected' THEN 1 END) as rejected
                            FROM db_recipes 
                            WHERE created_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
                            GROUP BY DATE(created_at)
                            ORDER BY date DESC";
            
            $stmt = $this->conn->prepare($trend_query);
            $stmt->bindParam(':days', $days);
            $stmt->execute();
            $analytics['submission_trends'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Category distribution
            $category_query = "SELECT 
                                 c.category_name,
                                 c.category_type,
                                 COUNT(rc.recipe_id) as recipe_count
                               FROM db_categories c
                               LEFT JOIN db_recipe_categories rc ON c.category_id = rc.category_id
                               LEFT JOIN db_recipes r ON rc.recipe_id = r.recipe_id AND r.status = 'verified'
                               GROUP BY c.category_id
                               ORDER BY recipe_count DESC
                               LIMIT 10";
            
            $stmt = $this->conn->prepare($category_query);
            $stmt->execute();
            $analytics['category_distribution'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // User engagement
            $engagement_query = "SELECT 
                                   COUNT(DISTINCT rv.user_id) as active_viewers,
                                   COUNT(DISTINCT rr.user_id) as active_reactors,
                                   COUNT(DISTINCT rc.user_id) as active_commenters,
                                   AVG(r.view_count) as avg_views_per_recipe
                                 FROM db_recipes r
                                 LEFT JOIN db_recipe_views rv ON r.recipe_id = rv.recipe_id AND rv.viewed_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
                                 LEFT JOIN db_recipe_reactions rr ON r.recipe_id = rr.recipe_id AND rr.created_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
                                 LEFT JOIN db_recipe_comments rc ON r.recipe_id = rc.recipe_id AND rc.created_at >= DATE_SUB(NOW(), INTERVAL :days DAY)
                                 WHERE r.status = 'verified'";
            
            $stmt = $this->conn->prepare($engagement_query);
            $stmt->bindParam(':days', $days);
            $stmt->execute();
            $analytics['user_engagement'] = $stmt->fetch(PDO::FETCH_ASSOC);

            return ['success' => true, 'data' => $analytics];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error fetching analytics: ' . $e->getMessage()];
        }
    }

    // Get pending recipes with priority scoring
    public function getPendingRecipesWithPriority() {
        try {
            $query = "SELECT 
                        r.*,
                        u.username,
                        u.full_name,
                        u.profile_photo,
                        TIMESTAMPDIFF(HOUR, r.created_at, NOW()) as hours_pending,
                        (
                          CASE 
                            WHEN TIMESTAMPDIFF(HOUR, r.created_at, NOW()) > 72 THEN 3  -- High priority after 3 days
                            WHEN TIMESTAMPDIFF(HOUR, r.created_at, NOW()) > 24 THEN 2  -- Medium priority after 1 day
                            ELSE 1  -- Normal priority
                          END
                        ) as priority_score
                      FROM db_recipes r
                      LEFT JOIN db_users u ON r.user_id = u.user_id
                      WHERE r.status = 'pending'
                      ORDER BY priority_score DESC, r.created_at ASC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return [
                'success' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error fetching pending recipes: ' . $e->getMessage()];
        }
    }

    // Bulk verify recipes
    public function bulkVerifyRecipes($recipe_ids, $admin_id) {
        try {
            $this->conn->beginTransaction();

            $placeholders = str_repeat('?,', count($recipe_ids) - 1) . '?';
            
            // Update recipes
            $update_query = "UPDATE db_recipes 
                           SET status = 'verified', verified_by = ?, verified_at = NOW() 
                           WHERE recipe_id IN ($placeholders) AND status = 'pending'";
            
            $stmt = $this->conn->prepare($update_query);
            $stmt->execute(array_merge([$admin_id], $recipe_ids));

            // Log verifications
            $log_query = "INSERT INTO db_admin_verifications (recipe_id, admin_id, action) VALUES (?, ?, 'verified')";
            $log_stmt = $this->conn->prepare($log_query);
            
            foreach ($recipe_ids as $recipe_id) {
                $log_stmt->execute([$recipe_id, $admin_id]);
            }

            $this->conn->commit();
            return ['success' => true, 'message' => count($recipe_ids) . ' recipes verified successfully'];

        } catch (Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'message' => 'Error bulk verifying recipes: ' . $e->getMessage()];
        }
    }

    // Get admin activity log
    public function getAdminActivityLog($admin_id = null, $limit = 50) {
        try {
            $where_clause = $admin_id ? "WHERE av.admin_id = :admin_id" : "";
            
            $query = "SELECT 
                        av.*,
                        r.title as recipe_title,
                        u.username as admin_username,
                        author.username as recipe_author
                      FROM db_admin_verifications av
                      LEFT JOIN db_recipes r ON av.recipe_id = r.recipe_id
                      LEFT JOIN db_users u ON av.admin_id = u.user_id
                      LEFT JOIN db_users author ON r.user_id = author.user_id
                      $where_clause
                      ORDER BY av.created_at DESC
                      LIMIT :limit";
            
            $stmt = $this->conn->prepare($query);
            if ($admin_id) {
                $stmt->bindParam(':admin_id', $admin_id);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            
            return [
                'success' => true,
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ];

        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Error fetching activity log: ' . $e->getMessage()];
        }
    }
}
?>