<?php
require_once 'admin/config.php';

session_start();

$site_title = 'Neu Cooking';
$domain = 'https://galvin.my.id/project/';
$baseUrl = $domain;
$loginUrl = $baseUrl.'login.php';
$currentUrl = $baseUrl.'write-recipies.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: $loginUrl");
    exit();
}

$title = '';
$description = '';
$portions = '';
$cooking_time_minutes = '';
$errorMessage = '';
$successMessage = '';
$recipe_image_path = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $portions = $_POST['portions'];
    $cooking_time_minutes = $_POST['cooking_time_minutes'];

    if (!$title || !$description || !$portions || !$cooking_time_minutes) {
        $errorMessage = "Please fill in all fields.";
    }

    if (!$errorMessage && (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK)) {
        $errorMessage = "Please upload a valid PNG photo.";
    }

    if (!$errorMessage) {
        $photo = $_FILES['photo'];
        $file_ext = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
        $file_size = $photo['size'];

        if ($file_ext !== 'png') {
            $errorMessage = "Only PNG images are allowed.";
        } elseif ($file_size > 300 * 1024) {
            $errorMessage = "File size must be 300KB or less.";
        } else {
            $upload_directory = 'uploads/recipes/';
            if (!is_dir($upload_directory)) {
                mkdir($upload_directory, 0755, true);
            }

            $unique_filename = uniqid('recipe_', true) . '.png';
            $destination = $upload_directory . $unique_filename;

            if (move_uploaded_file($photo['tmp_name'], $destination)) {
                $recipe_image_path = $destination;
            } else {
                $errorMessage = "Failed to save uploaded file.";
            }
        }
    }

    if (!$errorMessage) {
        $user_id = $_SESSION['user_id']; // You already validated login elsewhere

        $sql = "INSERT INTO db_recipes (user_id, title, description, portions, cooking_time_minutes, image_path) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssis", $user_id, $title, $description, $portions, $cooking_time_minutes, $recipe_image_path);

        if ($stmt->execute()) {
            $recipe_id = $conn->insert_id;
            $category_ids = json_decode($_POST['recipe_categories'], true);

            if (is_array($category_ids)) {
                $stmt_category = $conn->prepare("INSERT INTO db_recipe_categories (recipe_id, category_id) VALUES (?, ?)");
                foreach ($category_ids as $cat_id) {
                    $stmt_category->bind_param("ii", $recipe_id, $cat_id);
                    $stmt_category->execute();
                }
                $stmt_category->close();
            }

            $successMessage = "Recipe submitted successfully! Please wait for verification.";
            $title = $description = $portions = $cooking_time_minutes = '';
            $recipe_image_path = null;
        } else {
            $errorMessage = "Database error: " . $stmt->error;
        }

        $stmt->close();
    }
}

?>
<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style> <?php include 'css/style.css'; ?> </style>
    <style>
    /* Enhanced dropdown styling */
    .category-dropdown .dropdown-menu {
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-radius: 12px;
        padding: 0;
        margin-top: 8px;
    }
    /* Target all checked Bootstrap checkboxes */
    .form-check-input:checked {
        background-color: var(--primary-color); /* Example: Bootstrap's orange */
        border-color: var(--primary-color);
    }
    /* Optional: Improve checkbox hover */
    .form-check-input:hover {
        cursor: pointer;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25); /* subtle orange glow */
    }
    /* Search input styling */
    .category-search {
        position: sticky;
        top: 0;
        background: white;
        border-bottom: 1px solid #e9ecef;
        padding: 12px 16px;
        border-radius: 12px 12px 0 0;
        z-index: 10;
    }
    .category-search .form-control {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.9rem;
    }
    .category-search .form-control:focus {
        border-color: var(--primary-color);
    }
    /* Category options list styling */
    .category-options-container {
        max-height: 280px;
        overflow-y: auto;
        padding: 8px 0;
    }
    .category-option {
        margin: 0;
        padding: 0;
        border: none;
        background: none;
    }
    .category-option-content {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        margin: 2px 8px;
        border-radius: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid transparent;
    }
    .category-option-content:hover {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }
    .category-option-content.selected {
        background-color: var(--bs-warning-bg-subtle) !important;
        color: var(--bs-warning-text-emphasis) !important;
    }
    .category-checkbox {
        margin-right: 12px;
        width: 18px;
        height: 18px;
        accent-color: #fd7e14;
    }
    .category-icon {
        margin-right: 8px;
        color: #6c757d;
        font-size: 1rem;
    }
    .category-label {
        font-size: 0.95rem;
        font-weight: 500;
        color: #495057;
        margin: 0;
        cursor: pointer;
    }
    /* Selected tags styling */
    .selected-tags {
        margin-top: 12px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .category-tag {
        background-color: var(--bs-warning-bg-subtle) !important;
        color: var(--bs-warning-text-emphasis) !important;
        border: none;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    .category-tag:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(253, 126, 20, 0.3);
    }
    .tag-remove-btn {
        background-color: var(--bs-warning-bg-subtle) !important;
        border: none;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 12px;
        transition: background-color 0.2s ease;
    }
    .tag-remove-btn:hover {
        background: rgba(0,0,0,0.4);
    }
    /* Dropdown button styling */
    .category-dropdown-btn {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 12px 16px;
        background: white;
        transition: all 0.2s ease;
        min-height: 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .category-dropdown-btn:hover {
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.1);
    }
    .category-dropdown-btn:focus {
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
    }
    .dropdown-toggle::after {
        color: #6c757d;
    }
    .no-categories {
        color: #6c757d;
    }
    /* Scrollbar styling */
    .category-options-container::-webkit-scrollbar {
        width: 6px;
    }
    .category-options-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .category-options-container::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    .category-options-container::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    </style>
</head>
<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="recipe-form">
                            <form method="POST" action="" id="recipeForm" class="recipe-form" enctype="multipart/form-data">
                                <div class="card recipe-card border-0 rounded-3 mb-4">
                                    <div class="card-body pt-2">
                                        <?php 
                                        if (!empty($errorMessage)) {
                                            echo "
                                            <div>
                                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                    <strong>$errorMessage</strong>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>
                                            </div>
                                            ";
                                        }
                                        if (!empty($successMessage)) {
                                            echo "
                                            <div>
                                                <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                                                    <strong>$successMessage</strong>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>
                                            </div>
                                            ";
                                        }
                                        ?>
                                        <div class="mb-4">
                                            <label for="recipeTitle" class="form-label fw-semibold">Recipe Title</label>
                                            <input type="text" class="form-control recipe-input" id="recipeTitle" name="title" value="<?php echo $title ?>" placeholder="Insert an interesting title..">
                                        </div>
                                        <div class="mb-4">
                                            <label for="recipeCategory" class="form-label fw-semibold">Recipe Category</label>
                                            <div class="dropdown category-dropdown">
                                                <button class="form-control text-start dropdown-toggle category-dropdown-btn bg-light rounded-2" type="button" id="categoryDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span id="selectedCategorySummary">Select categories..</span>
                                                </button>
                                                <ul class="dropdown-menu w-100 shadow-sm border" id="categoryDropdownMenu">
                                                    <!-- Search input -->
                                                    <li class="category-search">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text border-end-0 bg-transparent">
                                                                <i class="bi bi-search text-muted"></i>
                                                            </span>
                                                            <input type="text" class="form-control" id="categorySearchInput" placeholder="Search categories..." autocomplete="off">
                                                        </div>
                                                    </li>
                                                    <!-- Categories container -->
                                                    <div class="category-options-container" id="categoryOptionsList">
                                                        <!-- Categories will be rendered here -->
                                                    </div>
                                                    <li class="no-categories d-none text-center fst-italic pb-3" id="noCategoriesMessage">
                                                        <i class="bi bi-search me-2"></i>No categories found
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Selected badges -->
                                            <div class="selected-tags" id="selectedTagsContainer"></div>
                                            <input type="hidden" name="recipe_categories" id="recipeCategoriesInput">
                                            <div class="d-none">
                                                <h6>Selected Categories JSON:</h6>
                                                <code id="jsonOutput">[]</code>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Recipe Photo</label>
                                            <div class="photo-upload-area position-relative">
                                                <input type="file" class="d-none" id="recipePhoto" name="photo" accept="image/*">
                                                <div class="upload-placeholder rounded-3 text-center" onclick="document.getElementById('recipePhoto').click()">
                                                    <div class="upload-icon">
                                                        <i class="bi bi-camera text-muted mb-2"></i>
                                                    </div>
                                                    <p class="text-muted mb-1">Click to add a photo</p>
                                                    <small class="text-muted">Format: PNG (Max 300KB)</small>
                                                </div>
                                                <div class="photo-preview-container position-relative d-none">
                                                    <img id="photoPreview" class="photo-preview w-100 object-fit-cover rounded-3" alt="Preview">
                                                    <button type="button" id="deletePhotoBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 rounded-circle d-flex align-items-center justify-content-center text-center" style="width: 32px; height: 32px;">
                                                        <i class="bi bi-x fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="recipeDesc" class="form-label fw-semibold">Description</label>
                                            <textarea class="form-control recipe-textarea" id="recipeDesc" name="description" placeholder="Tell us more about this recipe.." rows="3"></textarea>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="portions" class="form-label fw-semibold">Portion</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control recipe-input" id="portions" name="portions" min="1" value="<?php echo $portions ?>" placeholder="4">
                                                    <span class="input-group-text">people</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cookTime" class="form-label fw-semibold">Cooking Time</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control recipe-input" id="cookTime" name="cooking_time_minutes" min="1" value="<?php echo $cooking_time_minutes ?>" placeholder="30">
                                                    <span class="input-group-text">minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card recipe-card mb-4">
                                    <div class="card-header bg-white border-0 pb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title ingredients-title mb-0">
                                                <i class="bi bi-list-ul me-2"></i>Ingredients
                                            </h5>
                                            <button type="button" class="btn btn-ingredients-steps btn-sm" onclick="addIngredient()">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div id="ingredientsList" class="ingredients-list">
                                            <div class="ingredient-item p-3 rounded-2 mb-3">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-12 col-md-5">
                                                        <input type="text" class="form-control recipe-input" name="ingredient_name[]" placeholder="Ingredient name">
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <input type="text" class="form-control recipe-input" name="ingredient_amount[]" placeholder="Amount">
                                                    </div>
                                                    <div class="col-10 col-md-3">
                                                        <input type="text" class="form-control recipe-input" name="ingredient_unit[]" placeholder="Unit">
                                                    </div>
                                                    <div class="col-2 col-md-1 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeIngredient(this)" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card recipe-card mb-4">
                                    <div class="card-header bg-white border-0 pb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title steps-title mb-0">
                                                <i class="bi bi-list-ol me-2"></i>How to Make
                                            </h5>
                                            <button type="button" class="btn btn-ingredients-steps btn-sm" onclick="addStep()">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div id="stepsList" class="steps-list">
                                            <div class="step-item p-3 rounded-2 mb-3" draggable="true">
                                                <div class="d-flex align-items-start">
                                                    <!-- <div class="step-drag-handle me-2">
                                                        <i class="bi bi-grip-vertical text-muted"></i>
                                                    </div> -->
                                                    <span class="step-number d-inline-flex justify-content-center align-items-center text-white rounded-circle fw-bold">1</span>
                                                    <div class="flex-fill">
                                                        <textarea class="form-control recipe-textarea step-textarea mb-2" name="step_description[]" rows="2" placeholder="Explain this step in detail.."></textarea>
                                                        <div class="step-photo-upload mt-2">
                                                            <input type="file" name="step_photo[]" accept="image/*" class="d-none step-photo-input">
                                                            <div class="step-photo-placeholder text-center rounded-2" onclick="this.previousElementSibling.click()">
                                                                <i class="bi bi-camera me-2"></i>
                                                                <span>Add photo</span>
                                                            </div>
                                                            <img class="step-photo-preview d-none w-100 object-fit-cover rounded-1 mt-2" alt="Step preview">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeStep(this)" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 form-actions d-flex">
                                    <div class="col-6 d-flex justify-content-start">
                                        <button type="button" class="btn btn-outline-secondary btn-write-action px-3" disabled>
                                            <i class="bi bi-save me-2"></i>Save Draft
                                        </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-write-action btn-ingredients-steps px-3">
                                            <i class="bi bi-send me-2"></i>Publish
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        <div class="m-5"></div>
        <?php include 'parts/footer.php'; ?>

        </div>
    <!-- End of wrapper -->
    </div>
<?php
$categories_from_db = [];
$sql = "SELECT id, category_name, category_type, icon FROM db_categories ORDER BY id ASC"; 
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories_from_db[] = [
            'id' => (int)$row['id'],
            'label' => $row['category_name'],
            'icon' => $row['icon']
        ];
    }
}
?>
<script>
const categories = <?php echo json_encode($categories_from_db); ?>;

let selectedCategories = [];
let filteredCategories = [...categories];

function renderCategoryOptions() {
    const container = document.getElementById("categoryOptionsList");
    const noResultsMsg = document.getElementById("noCategoriesMessage");

    container.innerHTML = "";

    if (filteredCategories.length === 0) {
        noResultsMsg.classList.remove('d-none');
        return;
    }

    noResultsMsg.classList.add('d-none');

    filteredCategories.forEach(cat => {
        const li = document.createElement("li");
        li.className = "category-option";
        
        const isSelected = selectedCategories.includes(cat.id);
        
        li.innerHTML = `
            <div class="category-option-content ${isSelected ? 'selected' : ''}" onclick="toggleCategory(${cat.id})">
                <input class="form-check-input category-checkbox m-2 me-3" type="checkbox" value="${cat.id}" id="cat-${cat.id}" ${isSelected ? 'checked' : ''} onchange="event.stopPropagation(); toggleCategory(${cat.id})">
                <i class="bi ${cat.icon || 'bi-tag'} category-icon"></i>
                <label class="category-label" for="cat-${cat.id}">${cat.label}</label>
            </div>
        `;
        container.appendChild(li);
    });
}

function toggleCategory(id) {
    id = parseInt(id);
    const index = selectedCategories.indexOf(id);

    if (index > -1) {
        selectedCategories.splice(index, 1);
    } else {
        selectedCategories.push(id);
    }

    updateHiddenInput();
    updateSelectedDisplay();
    renderCategoryOptions(); // Re-render to update selected state
}

function updateSelectedDisplay() {
    const tagsContainer = document.getElementById("selectedTagsContainer");
    const summary = document.getElementById("selectedCategorySummary");

    if (selectedCategories.length === 0) {
        summary.textContent = "Select categories..";
        tagsContainer.innerHTML = "";
        return;
    }

    const selected = categories.filter(c => selectedCategories.includes(c.id));
    // Update summary text
    if (selected.length === 1) {
        summary.textContent = selected[0].label;
    } else {
        summary.textContent = `${selected.length} categories selected`;
    }

    // Update tags
    tagsContainer.innerHTML = selected.map(c => `
        <span class="badge category-tag">
            <i class="bi ${c.icon || 'bi-tag'}"></i>
            ${c.label}
            <button type="button" class="tag-remove-btn rounded-circle" aria-label="Remove" onclick="removeCategory(${c.id})">
                <i class="bi bi-x"></i>
            </button>
        </span>
    `).join('');
}

function removeCategory(id) {
    selectedCategories = selectedCategories.filter(catId => catId !== id);
    updateHiddenInput();
    updateSelectedDisplay();
    renderCategoryOptions();
}

function updateHiddenInput() {
    const jsonValue = JSON.stringify(selectedCategories);
    document.getElementById("recipeCategoriesInput").value = jsonValue;
    document.getElementById("jsonOutput").textContent = jsonValue;
}

function filterCategories(searchTerm) {
    const term = searchTerm.toLowerCase().trim();
    if (!term) {
        filteredCategories = [...categories];
    } else {
        filteredCategories = categories.filter(cat => 
            cat.label.toLowerCase().includes(term)
        );
    }
    renderCategoryOptions();
}

// Initialize
document.addEventListener("DOMContentLoaded", () => {
    renderCategoryOptions();
    updateSelectedDisplay();

    // Search functionality
    const searchInput = document.getElementById("categorySearchInput");
    searchInput.addEventListener("input", (e) => {
        filterCategories(e.target.value);
    });

    // Clear search when dropdown is closed
    document.getElementById("categoryDropdownButton").addEventListener("hidden.bs.dropdown", () => {
        searchInput.value = "";
        filteredCategories = [...categories];
        renderCategoryOptions();
    });

    // Focus search input when dropdown opens
    document.getElementById("categoryDropdownButton").addEventListener("shown.bs.dropdown", () => {
        searchInput.focus();
    });

    // Prevent dropdown from closing when clicking inside
    document.getElementById("categoryDropdownMenu").addEventListener("click", (e) => {
        e.stopPropagation();
    });
});

let ingredientCount = 1;
let stepCount = 1;

// Photo upload preview
document.getElementById('recipePhoto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('photoPreview');
            const placeholder = document.querySelector('.upload-placeholder');
            const previewContainer = document.querySelector('.photo-preview-container');
            
            preview.src = e.target.result;
            previewContainer.classList.remove('d-none');
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
});

// Delete photo functionality
document.getElementById('deletePhotoBtn').addEventListener('click', function(e) {
    e.stopPropagation(); // Prevent triggering the file input
    
    const preview = document.getElementById('photoPreview');
    const placeholder = document.querySelector('.upload-placeholder');
    const previewContainer = document.querySelector('.photo-preview-container');
    const fileInput = document.getElementById('recipePhoto');
    
    // Reset the file input
    fileInput.value = '';
    
    // Hide preview and show placeholder
    previewContainer.classList.add('d-none');
    placeholder.style.display = 'block';
    
    // Clear the preview image source
    preview.src = '';
});

// Add ingredient function
function addIngredient() {
    ingredientCount++;
    const ingredientsList = document.getElementById('ingredientsList');
    const newIngredient = document.createElement('div');
    newIngredient.className = 'ingredient-item p-3 mb-3';
    newIngredient.innerHTML = `
        <div class="row g-2 align-items-center">
            <div class="col-12 col-md-5">
                <input type="text" class="form-control recipe-input" 
                    name="ingredient_name[]" placeholder="Ingredient name">
            </div>
            <div class="col-12 col-md-3">
                <input type="text" class="form-control recipe-input" 
                    name="ingredient_amount[]" placeholder="Amount">
            </div>
            <div class="col-10 col-md-3">
                <input type="text" class="form-control recipe-input" 
                    name="ingredient_unit[]" placeholder="Unit">
            </div>
            <div class="col-2 col-md-1 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeIngredient(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    ingredientsList.appendChild(newIngredient);
    updateRemoveButtons('ingredient');
}

// Remove ingredient function
function removeIngredient(button) {
    button.closest('.ingredient-item').remove();
    ingredientCount--;
    updateRemoveButtons('ingredient');
}

// Add step function
function addStep() {
    stepCount++;
    const stepsList = document.getElementById('stepsList');
    const newStep = document.createElement('div');
    newStep.className = 'step-item rounded-2 p-3 mb-3';
    newStep.setAttribute('draggable', 'true');
    newStep.innerHTML = `
        <div class="d-flex align-items-start">
            <span class="step-number d-inline-flex justify-content-center align-items-center text-white rounded-circle fw-bold">${stepCount}</span>
            <div class="flex-fill">
                <textarea class="form-control recipe-textarea step-textarea mb-2" 
                        name="step_description[]" rows="2" 
                        placeholder="Explain this step in detail.."></textarea>
                <div class="step-photo-upload mt-2">
                    <input type="file" name="step_photo[]" accept="image/*" class="d-none step-photo-input">
                    <div class="step-photo-placeholder text-center rounded-2" onclick="this.previousElementSibling.click()">
                        <i class="bi bi-camera me-2"></i>
                        <span>Add photo</span>
                    </div>
                    <img class="step-photo-preview d-none w-100 object-fit-cover rounded-1 mt-2" alt="Step preview">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeStep(this)" disabled>
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    stepsList.appendChild(newStep);
    updateRemoveButtons('step');
    
    // Add event listener for the new step photo input
    const newPhotoInput = newStep.querySelector('.step-photo-input');
    newPhotoInput.addEventListener('change', handleStepPhotoUpload);
}

// Remove step function
function removeStep(button) {
    button.closest('.step-item').remove();
    stepCount--;
    updateStepNumbers();
    updateRemoveButtons('step');
}

// Update step numbers
function updateStepNumbers() {
    const stepNumbers = document.querySelectorAll('.step-number');
    stepNumbers.forEach((num, index) => {
        num.textContent = index + 1;
    });
}

// Update remove button states
function updateRemoveButtons(type) {
    const items = document.querySelectorAll(type === 'ingredient' ? '.ingredient-item' : '.step-item');
    const buttons = document.querySelectorAll(type === 'ingredient' ? 
        '.ingredient-item .btn-outline-danger' : '.step-item .btn-outline-danger');
    
    buttons.forEach((button, index) => {
        button.disabled = items.length === 1;
    });
}

// Initialize remove button states
updateRemoveButtons('ingredient');
updateRemoveButtons('step');

// Add event listeners for step photo uploads
function handleStepPhotoUpload(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        const stepItem = e.target.closest('.step-item');
        const preview = stepItem.querySelector('.step-photo-preview');
        const placeholder = stepItem.querySelector('.step-photo-placeholder');
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
}

// Add event listener to initial step photo input
document.querySelector('.step-photo-input').addEventListener('change', handleStepPhotoUpload);
</script>
<script> <?php include 'js/script.js'; ?> </script>
</body>
</html>