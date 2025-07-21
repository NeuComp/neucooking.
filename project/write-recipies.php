<?php
require 'admin/config.php';
require 'admin/data.php';
session_start();

$site_title = 'Neu Cooking';
$domain = 'https://galvin.my.id/project/';
$baseUrl = $domain;
$loginUrl = $baseUrl.'login.php';

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    echo "<script type='text/javascript'>
        window.location.href = '$loginUrl';
    </script>";
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style> <?php include 'css/style.css'; ?> </style>
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
                            <form id="recipeForm" class="recipe-form" enctype="multipart/form-data">
                                <!-- Basic Information Card -->
                                <div class="card recipe-card border-0 rounded-3 mb-4">
                                    <div class="card-body pt-2">
                                        <!-- Recipe Title -->
                                        <div class="d-none d-md-block mb-4">
                                            <label for="recipeTitle" class="form-label fw-semibold">Recipe Title</label>
                                            <input type="text" class="form-control form-control-lg recipe-input" id="recipeTitle" name="recipe_title" placeholder="Insert an interesting title..">
                                        </div>
                                        <div class="d-block d-md-none mb-4">
                                            <label for="recipeTitle" class="form-label fw-semibold">Recipe Title</label>
                                            <input type="text" class="form-control form-control recipe-input" id="recipeTitle" name="recipe_title" placeholder="Insert an interesting title..">
                                        </div>
                                        <!-- Photo Upload Section -->
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold">Recipe Photo</label>
                                            <div class="photo-upload-area position-relative">
                                                <input type="file" class="d-none" id="recipePhoto" name="recipe_photo" accept="image/*">
                                                <div class="upload-placeholder rounded-3 text-center" onclick="document.getElementById('recipePhoto').click()">
                                                    <div class="upload-icon">
                                                        <i class="bi bi-camera text-muted mb-2"></i>
                                                    </div>
                                                    <p class="text-muted mb-1">Click to add a photo</p>
                                                    <small class="text-muted">Format: JPG, PNG (Max 300KB)</small>
                                                </div>
                                                <div class="photo-preview-container position-relative d-none">
                                                    <img id="photoPreview" class="photo-preview w-100 object-fit-cover rounded-3" alt="Preview">
                                                    <button type="button" id="deletePhotoBtn" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 rounded-circle d-flex align-items-center justify-content-center text-center" style="width: 32px; height: 32px;">
                                                        <i class="bi bi-x fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Description -->
                                        <div class="mb-4">
                                            <label for="recipeDesc" class="form-label fw-semibold">Description</label>
                                            <textarea class="form-control recipe-textarea" id="recipeDesc" name="recipe_description" rows="3" placeholder="Tell us more about this dish. What makes this dish so special that you've been inspired to make this dish?"></textarea>
                                        </div>

                                        <!-- Recipe Meta Info -->
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="portions" class="form-label fw-semibold">Portion</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control recipe-input" id="portions" name="portions" min="1" placeholder="4">
                                                    <span class="input-group-text">people</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cookTime" class="form-label fw-semibold">Cooking Time</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control recipe-input" id="cookTime" name="cook_time" min="1" placeholder="30">
                                                    <span class="input-group-text">minutes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ingredients Card -->
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
                                            <!-- Initial ingredient input -->
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

                                <!-- Steps Card -->
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
                                            <!-- Initial step input -->
                                            <div class="step-item p-3 rounded-2 mb-3" draggable="true">
                                                <div class="d-flex align-items-start">
                                                    <div class="step-drag-handle me-2">
                                                        <i class="bi bi-grip-vertical text-muted"></i>
                                                    </div>
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

                                <!-- Action Buttons -->
                                <div class="col-12 form-actions d-flex">
                                    <div class="col-6 d-flex justify-content-start">
                                        <button type="button" class="btn btn-outline-secondary btn-write-action px-3">
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
                <div class="step-drag-handle me-2">
                    <i class="bi bi-grip-vertical text-muted"></i>
                </div>
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
    
    // Form submission
    document.getElementById('recipeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const title = document.getElementById('recipeTitle').value.trim();
        const ingredients = document.querySelectorAll('input[name="ingredient_name[]"]');
        const steps = document.querySelectorAll('textarea[name="step_description[]"]');
        
        if (!title) {
            alert('Recipe title has to be filled!');
            return;
        }
        
        let hasIngredients = false;
        ingredients.forEach(input => {
            if (input.value.trim()) hasIngredients = true;
        });
        
        if (!hasIngredients) {
            alert('Ingredients form has to be filled!');
            return;
        }
        
        let hasSteps = false;
        steps.forEach(input => {
            if (input.value.trim()) hasSteps = true;
        });
        
        if (!hasSteps) {
            alert('Steps form has to be filled!');
            return;
        }
        
        // If validation passes, submit the form
        alert('Recipe has been successfully made! (Waiting for admin authorization.)');
        // Ini bagian submit, akan ke dashboard admin baru ke content
        // this.submit();
    });
    
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