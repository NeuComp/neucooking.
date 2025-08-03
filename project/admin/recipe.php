<?php
class Recipe
{
    private $conn;
    private $table_name = "db_recipes";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Create recipe
    public function create($data)
    {
        try {
            $this->conn->beginTransaction();

            // Insert main recipe
            $query = "INSERT INTO " . $this->table_name . " 
            (user_id, title, description, photo, portions, cooking_time_minutes) VALUES (:user_id, :title, :description, :photo, :portions, :cooking_time)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $data['user_id']);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':photo', $data['photo']);
            $stmt->bindParam(':portions', $data['portions']);
            $stmt->bindParam(':cooking_time', $data['cooking_time_minutes']);

            $stmt->execute();
            $recipe_id = $this->conn->lastInsertId();

            // Insert categories
            if (!empty($data['categories'])) {
                $cat_query = "INSERT INTO db_recipe_categories (recipe_id, category_id) VALUES (:recipe_id, :category_id)";
                $cat_stmt = $this->conn->prepare($cat_query);

                foreach ($data['categories'] as $category_id) {
                    $cat_stmt->bindParam(':recipe_id', $recipe_id);
                    $cat_stmt->bindParam(':category_id', $category_id);
                    $cat_stmt->execute();
                }
            }

            // Insert ingredients
            if (!empty($data['ingredients'])) {
                $ing_query = "INSERT INTO db_recipe_ingredients (recipe_id, ingredient_name, amount, unit, order_index) VALUES (:recipe_id, :ingredient_name, :amount, :unit, :order_index)";
                $ing_stmt = $this->conn->prepare($ing_query);

                foreach ($data['ingredients'] as $index => $ingredient) {
                    $ing_stmt->bindParam(':recipe_id', $recipe_id);
                    $ing_stmt->bindParam(':ingredient_name', $ingredient['name']);
                    $ing_stmt->bindParam(':amount', $ingredient['amount']);
                    $ing_stmt->bindParam(':unit', $ingredient['unit']);
                    $ing_stmt->bindParam(':order_index', $index);
                    $ing_stmt->execute();
                }
            }

            // Insert steps
            if (!empty($data['steps'])) {
                $step_query = "INSERT INTO db_recipe_steps (recipe_id, step_number, description, photo) VALUES (:recipe_id, :step_number, :description, :photo)";
                $step_stmt = $this->conn->prepare($step_query);

                foreach ($data['steps'] as $index => $step) {
                    $step_stmt->bindParam(':recipe_id', $recipe_id);
                    $step_stmt->bindParam(':step_number', $index + 1);
                    $step_stmt->bindParam(':description', $step['description']);
                    $step_stmt->bindParam(':photo', $step['photo'] ?? null);
                    $step_stmt->execute();
                }
            }

            $this->conn->commit();
            return ['success' => true, 'recipe_id' => $recipe_id, 'message' => 'Recipe submitted for review'];

        } catch (Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'message' => 'Error creating recipe: ' . $e->getMessage()];
        }
    }

    // Get recipe details
    public function getRecipeDetails($recipe_id)
    {
        $query = "SELECT r.*, u.username, u.full_name, u.profile_photo,
            GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') as categories
            FROM " . $this->table_name . " r
            LEFT JOIN db_users u ON r.user_id = u.user_id
            LEFT JOIN db_recipe_categories rc ON r.recipe_id = rc.recipe_id
            LEFT JOIN db_categories c ON rc.category_id = c.category_id
            WHERE r.recipe_id = :recipe_id
            GROUP BY r.recipe_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recipe_id', $recipe_id);
        $stmt->execute();

        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($recipe) {
            // Get ingredients
            $ing_query = "SELECT * FROM db_recipe_ingredients WHERE recipe_id = :recipe_id ORDER BY order_index";
            $ing_stmt = $this->conn->prepare($ing_query);
            $ing_stmt->bindParam(':recipe_id', $recipe_id);
            $ing_stmt->execute();
            $recipe['ingredients'] = $ing_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get steps
            $step_query = "SELECT * FROM db_recipe_steps WHERE recipe_id = :recipe_id ORDER BY step_number";
            $step_stmt = $this->conn->prepare($step_query);
            $step_stmt->bindParam(':recipe_id', $recipe_id);
            $step_stmt->execute();
            $recipe['steps'] = $step_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get comments
            $comment_query = "SELECT c.*, u.username, u.profile_photo 
                FROM db_recipe_comments c
                LEFT JOIN db_users u ON c.user_id = u.user_id
                WHERE c.recipe_id = :recipe_id AND c.is_active = 1
                ORDER BY c.created_at DESC";
            $comment_stmt = $this->conn->prepare($comment_query);
            $comment_stmt->bindParam(':recipe_id', $recipe_id);
            $comment_stmt->execute();
            $recipe['comments'] = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get replates
            $replate_query = "SELECT r.*, u.username, u.profile_photo 
                FROM db_recipe_replates r
                LEFT JOIN db_users u ON r.user_id = u.user_id
                WHERE r.original_recipe_id = :recipe_id AND r.is_public = 1
                ORDER BY r.created_at DESC";
            $replate_stmt = $this->conn->prepare($replate_query);
            $replate_stmt->bindParam(':recipe_id', $recipe_id);
            $replate_stmt->execute();
            $recipe['replates'] = $replate_stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $recipe;
    }

    // Admin verification
    public function verifyRecipe($recipe_id, $admin_id, $action, $note = null)
    {
        try {
            $this->conn->beginTransaction();

            // Update recipe status
            $query = "UPDATE " . $this->table_name . " 
                SET status = :status, verified_by = :admin_id, verified_at = NOW(), admin_note = :note WHERE recipe_id = :recipe_id";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':status', $action);
            $stmt->bindParam(':admin_id', $admin_id);
            $stmt->bindParam(':note', $note);
            $stmt->bindParam(':recipe_id', $recipe_id);
            $stmt->execute();

            // Log verification action
            $log_query = "INSERT INTO db_admin_verifications (recipe_id, admin_id, action, note) VALUES (:recipe_id, :admin_id, :action, :note)";
            $log_stmt = $this->conn->prepare($log_query);
            $log_stmt->bindParam(':recipe_id', $recipe_id);
            $log_stmt->bindParam(':admin_id', $admin_id);
            $log_stmt->bindParam(':action', $action);
            $log_stmt->bindParam(':note', $note);
            $log_stmt->execute();

            $this->conn->commit();
            return ['success' => true, 'message' => 'Recipe ' . $action . ' successfully'];

        } catch (Exception $e) {
            $this->conn->rollback();
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    // Record recipe view
    public function recordView($recipe_id, $user_id = null, $ip_address = null)
    {
        // Prevent duplicate views from same user within 24 hours
        if ($user_id) {
            $check_query = "SELECT view_id FROM db_recipe_views WHERE recipe_id = :recipe_id AND user_id = :user_id AND viewed_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
            $check_stmt = $this->conn->prepare($check_query);
            $check_stmt->bindParam(':recipe_id', $recipe_id);
            $check_stmt->bindParam(':user_id', $user_id);
            $check_stmt->execute();

            if ($check_stmt->fetch()) {
                return false; // Already viewed recently
            }
        }

        $query = "INSERT INTO db_recipe_views (recipe_id, user_id, ip_address) VALUES (:recipe_id, :user_id, :ip_address)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':recipe_id', $recipe_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':ip_address', $ip_address);

        return $stmt->execute();
    }

    // Search recipes
    public function searchRecipes($search_term, $category_ids = [], $limit = 20, $offset = 0)
    {
        $conditions = ["r.status = 'verified'"];
        $params = [];

        if (!empty($search_term)) {
            $conditions[] = "(r.title LIKE :search OR r.description LIKE :search OR EXISTS (SELECT 1 FROM db_recipe_ingredients ri WHERE ri.recipe_id = r.recipe_id AND ri.ingredient_name LIKE :search))";
            $params[':search'] = '%' . $search_term . '%';
        }

        if (!empty($category_ids)) {
            $placeholders = str_repeat('?,', count($category_ids) - 1) . '?';
            $conditions[] = "EXISTS (SELECT 1 FROM db_recipe_categories rc WHERE rc.recipe_id = r.recipe_id AND rc.category_id IN ($placeholders))";
            foreach ($category_ids as $i => $cat_id) {
                $params[':cat' . $i] = $cat_id;
            }
        }

        $where_clause = implode(' AND ', $conditions);

        $query = "SELECT r.*, u.username, u.full_name,
            GROUP_CONCAT(DISTINCT c.category_name SEPARATOR ', ') as categories,
            COUNT(DISTINCT rr.reaction_id) as reaction_count,
            COUNT(DISTINCT rc.comment_id) as comment_count
            FROM db_recipes r
            LEFT JOIN db_users u ON r.user_id = u.user_id
            LEFT JOIN db_recipe_categories rcat ON r.recipe_id = rcat.recipe_id
            LEFT JOIN db_categories c ON rcat.category_id = c.category_id
            LEFT JOIN db_recipe_reactions rr ON r.recipe_id = rr.recipe_id
            LEFT JOIN db_recipe_comments rc ON r.recipe_id = rc.recipe_id
            WHERE $where_clause
            GROUP BY r.recipe_id
            ORDER BY r.view_count DESC, reaction_count DESC
            LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get pending recipes for admin
    public function getPendingRecipes()
    {
        $query = "SELECT r.*, u.username, u.full_name 
            FROM " . $this->table_name . " r
            LEFT JOIN db_users u ON r.user_id = u.user_id
            WHERE r.status = 'pending'
            ORDER BY r.created_at ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get popular recipes
    public function getPopularRecipes($limit = 10)
    {
        $query = "SELECT * FROM v_popular_recipes LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>