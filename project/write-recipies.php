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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $portions = mysqli_real_escape_string($conn, $_POST['portions']);
    $cooking_time_minutes = mysqli_real_escape_string($conn, $_POST['cooking_time_minutes']);
    $recipe_image_path = null;

    if (empty($title) || empty($description) || empty($portions) || empty($cooking_time_minutes)) {
        $errorMessage = "Please fill in all fields.";
    }

    if (empty($errorMessage)) {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $photo = $_FILES['photo'];

            $allowed_extensions = ['png']; 
            $max_file_size = 300 * 1024;

            $file_name = $photo['name'];
            $file_size = $photo['size'];
            $file_tmp = $photo['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (!in_array($file_ext, $allowed_extensions)) {
                $errorMessage = "Extension not allowed. Please choose a PNG file.";
            } elseif ($file_size > $max_file_size) {
                $errorMessage = "File size must be 300KB or less.";
            }

            if (empty($errorMessage)) {
                $unique_filename = uniqid('recipe_', true) . '.' . $file_ext;
                $upload_directory = 'uploads/recipes/';

                if (!is_dir($upload_directory)) {
                    mkdir($upload_directory, 0755, true);
                }

                $destination = $upload_directory . $unique_filename;
                
                if (move_uploaded_file($file_tmp, $destination)) {
                    $recipe_image_path = $destination;
                } else {
                    $errorMessage = "Failed to upload photo. Please try again.";
                }
            }
        }
    }

    if (empty($errorMessage)) {
        $user_id = $_SESSION['user_id'];
        
        $insert_sql = "INSERT INTO db_recipes (user_id, title, description, portions, cooking_time_minutes, image_path) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("isssis", $user_id, $title, $description, $portions, $cooking_time_minutes, $recipe_image_path);

        if ($stmt->execute()) {
            $successMessage = "Recipe submitted successfully! Please wait for verification.";
            $title = '';
            $description = '';
            $portions = '';
            $cooking_time_minutes = '';
        } else {
            $errorMessage = "Failed to submit recipe. Please try again. Database error: " . $stmt->error;
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
        .multiselect-dropdown {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .multiselect-option:hover {
            background-color: var(--bs-light) !important;
        }
        
        .multiselect-option.selected {
            background-color: var(--bs-warning-bg-subtle) !important;
            color: var(--bs-warning-text-emphasis) !important;
        }
        
        .tag-remove {
            cursor: pointer;
        }
        
        .dropdown-toggle::after {
            transition: transform 0.2s ease;
        }
        
        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
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
                                            <input type="text" class="form-control form-control recipe-input" id="recipeTitle" name="title" value="<?php echo $title ?>" placeholder="Insert an interesting title..">
                                        </div>
                                        <div class="mb-4">
                                            <label for="recipeCategory" class="form-label fw-semibold">Recipe Category</label>
                                            <div class="dropdown w-100" id="recipeCategoryDropdown">
                                                <button class="recipe-input dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center rounded-3 py-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="categoryDropdownButton">
                                                    <div class="d-flex flex-wrap gap-1" id="selectedTagsContainer">
                                                        <span class="text-muted">Select categories..</span>
                                                    </div>
                                                </button>
                                                <div class="dropdown-menu w-100 p-0 multiselect-dropdown" id="categoryDropdownMenu">
                                                    <div class="p-3 border-bottom">
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="bi bi-search"></i>
                                                            </span>
                                                            <input type="text" class="form-control" placeholder="Search categories.." id="categorySearch" onkeyup="filterCategories(this.value)">
                                                        </div>
                                                    </div>
                                                    <div class="py-2" id="categoryOptionsList">
                                                        <!-- Options populated by JavaScript -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <h6 class="text-muted mb-2">Selected Categories:</h6>
                                                <div id="selectedCategoriesDisplay" class="text-secondary fst-italic">
                                                    None selected
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Recipe Photo</label>
                                            <?php 
                                            if (!empty($photo_errorMessage)) {
                                                echo "
                                                <div>
                                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                        <strong>$photo_errorMessage</strong>
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>
                                                </div>
                                                ";
                                            }
                                            ?>
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
                                            <textarea class="form-control recipe-textarea" id="recipeDesc" name="description" rows="3" placeholder="Tell us more about this dish. What makes this dish so special that you've been inspired to make this dish?"><?php echo htmlspecialchars($description); ?></textarea>
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

<script>
    const categories = [
        { value: 'simple-daily-dishes', label: 'Simple Daily Dishes', icon: 'bi-journal-text' },
        { value: 'breakfast', label: 'Breakfast', icon: 'bi-cup-hot' },
        { value: 'lunch', label: 'Lunch', icon: 'bi-bag' },
        { value: 'dinner', label: 'Dinner', icon: 'bi-moon' },
        { value: 'snacks', label: 'Snacks', icon: 'bi-cookie' },
        { value: 'desserts', label: 'Desserts', icon: 'bi-cake' },
        { value: 'beverages', label: 'Beverage', icon: 'bi-cup-straw' },

        { value: 'international-cuisine', label: 'International Cuisine', icon: 'bi-globe' },
        { value: 'indonesian', label: 'Indonesian', icon: 'bi-flag' },
        { value: 'chinese', label: 'Chinese', icon: 'bi-flag' },
        { value: 'japanese', label: 'Japanese', icon: 'bi-flag' },
        { value: 'korean', label: 'Korean', icon: 'bi-flag' },
        { value: 'western', label: 'Western', icon: 'bi-flag' },
        { value: 'middle-eastern', label: 'Middle Eastern', icon: 'bi-flag' },

        { value: 'diet-lifestyle', label: 'Diet Lifestyle', icon: 'bi-activity' },
        { value: 'vegan', label: 'Vegan', icon: 'bi-emoji-laughing-fill' },
        { value: 'gluten-free', label: 'Gluten Free', icon: 'bi-x-circle' },
        { value: 'dairy-free', label: 'Dairy Free', icon: 'bi-droplet-fill' },
        { value: 'low-carb', label: 'Low Carb', icon: 'bi-bar-chart-fill' },
        { value: 'high-protein', label: 'High Protein', icon: 'bi-arrow-up-circle' },
        { value: 'diabetic-friendly', label: 'Diabetic Friendly', icon: 'bi-heart-pulse' },

        { value: 'by-ingredient', label: 'By Ingredient', icon: 'bi-basket' },
        { value: 'red-meat', label: 'Red Meat', icon: 'bi-grid-fill' },
        { value: 'poultry-and-eggs', label: 'Poultry & Eggs', icon: 'bi-egg' },
        { value: 'seafood', label: 'Seafood', icon: 'bi-water' },
        { value: 'vegetables-and-fruit', label: 'Vegetables & Fruit', icon: 'bi-apple' },
        { value: 'noodles-and-pasta', label: 'Noodles & Pasta', icon: 'bi-chevron-double-down' },
        { value: 'rice-and-dough', label: 'Rice & Dough', icon: 'bi-circle-fill' },

        { value: 'cooking-technique', label: 'Cooking Technique', icon: 'bi-tools' },
        { value: 'stovetop', label: 'Stovetop', icon: 'bi-fire' },
        { value: 'baking', label: 'Baking', icon: 'bi-window' },
        { value: 'grilling', label: 'Grilling', icon: 'bi-bricks' },
        { value: 'roasting', label: 'Roasting', icon: 'bi-thermometer-half' },
        { value: 'air-frying', label: 'Air Frying', icon: 'bi-wind' }
    ];

    let selectedCategories = [];
    let filteredCategories = [...categories];

    function initializeComponent() {
        renderCategoryOptions();
        updateSelectedDisplay();
        
        // Prevent dropdown from closing when clicking inside
        document.getElementById('categoryDropdownMenu').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    function renderCategoryOptions() {
        const optionsList = document.getElementById('categoryOptionsList');
        
        if (filteredCategories.length === 0) {
            optionsList.innerHTML = `
                <div class="px-3 py-2 text-muted text-center">
                    <i class="bi bi-search me-2"></i>No categories found
                </div>
            `;
            return;
        }

        optionsList.innerHTML = filteredCategories.map(category => `
            <div class="px-3 py-2 multiselect-option ${selectedCategories.includes(category.value) ? 'selected' : ''}" 
                    onclick="toggleCategory('${category.value}')"
                    style="cursor: pointer;">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi ${selectedCategories.includes(category.value) ? 'bi-check-square-fill text-warning' : 'bi-square'} fs-5"></i>
                    </div>
                    <i class="bi ${category.icon} me-2 ${selectedCategories.includes(category.value) ? 'text-warning' : 'text-muted'}"></i>
                    <span class="${selectedCategories.includes(category.value) ? 'fw-semibold' : ''}">${category.label}</span>
                </div>
            </div>
        `).join('');
    }

    function toggleCategory(value) {
        if (selectedCategories.includes(value)) {
            selectedCategories = selectedCategories.filter(cat => cat !== value);
        } else {
            selectedCategories.push(value);
        }
        
        updateSelectedDisplay();
        renderCategoryOptions();
        updateHiddenInput();
    }

    function updateSelectedDisplay() {
        const tagsContainer = document.getElementById('selectedTagsContainer');
        const displayContainer = document.getElementById('selectedCategoriesDisplay');
        
        if (selectedCategories.length === 0) {
            tagsContainer.innerHTML = '<span class="text-muted">Select categories..</span>';
            displayContainer.innerHTML = '<span class="text-secondary fst-italic">None selected</span>';
        } else {
            // Update tags in dropdown button
            const tags = selectedCategories.map(value => {
                const category = categories.find(cat => cat.value === value);
                return `
                    <span class="badge bg-warning text-white me-1 mb-1 d-inline-flex align-items-center">
                        <i class="bi ${category.icon} me-1"></i>
                        ${category.label}
                        <button type="button" class="btn-close btn-close-dark ms-2 tag-remove" aria-label="Remove ${category.label}" style="font-size: 0.6em;" onclick="removeCategory('${value}', event)"></button>
                    </span>
                `;
            }).join('');
            
            tagsContainer.innerHTML = tags;
            
            // Update display list
            const selectedLabels = selectedCategories.map(value => {
                const category = categories.find(cat => cat.value === value);
                return `<i class="bi ${category.icon} me-1"></i>${category.label}`;
            }).join(', ');
            
            displayContainer.innerHTML = selectedLabels;
        }
    }

    function removeCategory(value, event) {
        event.stopPropagation();
        event.preventDefault();
        
        selectedCategories = selectedCategories.filter(cat => cat !== value);
        updateSelectedDisplay();
        renderCategoryOptions();
        updateHiddenInput();
    }

    function updateHiddenInput() {
        document.getElementById('recipeCategoriesInput').value = JSON.stringify(selectedCategories);
    }

    function filterCategories(searchTerm) {
        filteredCategories = categories.filter(category => 
            category.label.toLowerCase().includes(searchTerm.toLowerCase())
        );
        renderCategoryOptions();
    }

    // Clear search when dropdown opens
    document.getElementById('categoryDropdownButton').addEventListener('click', function() {
        setTimeout(() => {
            const searchInput = document.getElementById('categorySearch');
            searchInput.value = '';
            filteredCategories = [...categories];
            renderCategoryOptions();
            searchInput.focus();
        }, 100);
    });

    // Initialize component when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initializeComponent();
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