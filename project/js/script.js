        document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.querySelector('#toggle-btn');
        const sidebar = document.querySelector('#sidebar');
        const main = document.querySelector('.main');
        
        // Sidebar overlay
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
        
        // Open sidebar function
        function openSidebar() {
            sidebar.classList.add('expand');
            overlay.classList.add('active');
            if (main) {
                main.classList.add('sidebar-expanded');
            }
        }
        
        // Close sidebar
        function closeSidebar() {
            sidebar.classList.remove('expand');
            overlay.classList.remove('active');
            if (main) {
                main.classList.remove('sidebar-expanded');
            }
        }
        
        // Hamburger
        hamburger.addEventListener("click", function(e) {
            e.stopPropagation();
            if (sidebar.classList.contains('expand')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
        
        // Close by clicking overlay (Background shadow hitam di belakang)
        overlay.addEventListener('click', function() {
            closeSidebar();
        });
        
        // Preventing from closing (Kalau kita pencet sidebar)
        sidebar.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        
        // Close with escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('expand')) {
                closeSidebar();
            }
        });
        });
        
        const toggleBtn = document.getElementById("toggle-btn");
        const sidebar = document.getElementById("sidebar");
        
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("sidebar-expanded");
            sidebar.classList.toggle("sidebar-collapsed");
        });



        // Expandable text (di deskripsi produk)
        class AutoExpandableText {
        constructor() {
            this.initializeAll();
        }
        
        initializeAll() {
            const containers = document.querySelectorAll('.expandable-text');
            containers.forEach(container => this.initialize(container));
        }
        
        initialize(container) {
            const paragraph = container.querySelector('p');
            const maxLength = parseInt(container.getAttribute('data-max-length')) || 150;
            const originalText = paragraph.textContent.trim();
        
        // If text is shorter than max length, do nothing
        if (originalText.length <= maxLength) {
            return;
        }
        
        // Break point di akhir kata
        let breakPoint = maxLength;
        while (breakPoint > 0 && originalText[breakPoint] !== ' ') {
            breakPoint--;
        }
        
        // If no space found, use the original breakpoint
        if (breakPoint === 0) {
            breakPoint = maxLength;
        }
        
        const shortText = originalText.substring(0, breakPoint).trim();
        const remainingText = originalText.substring(breakPoint).trim();
        
        // Versi text-truncate (?)
        const shortSpan = document.createElement('span');
        shortSpan.className = 'short-text';
        shortSpan.textContent = shortText;
        
        const moreSpan = document.createElement('span');
        moreSpan.className = 'more-text d-none';
        moreSpan.textContent = ' ' + remainingText;
        
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'show-more-btn';
        toggleBtn.textContent = 'show more ';
        
        // Add click event
        toggleBtn.addEventListener('click', () => {
            if (moreSpan.classList.contains('d-none')) {
                moreSpan.classList.remove('d-none');
                toggleBtn.textContent = 'show less';
            } else {
                moreSpan.classList.add('d-none');
                toggleBtn.textContent = 'show more';
            }
        });
        
        // Replace paragraph content
        paragraph.innerHTML = '';
        paragraph.appendChild(shortSpan);
        paragraph.appendChild(moreSpan);
        paragraph.appendChild(toggleBtn);
        }}
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new AutoExpandableText();
        });



        // Log in & Register form pop up
        function openPopup() {
            document.getElementById('popupOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closePopup() {
            document.getElementById('popupOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
        
        function showLoginForm() {
            document.getElementById('loginForm').classList.add('active');
            document.getElementById('registerForm').classList.remove('active');
            document.getElementById('popupTitle').textContent = 'Log In';
            document.getElementById('popupSubtitle').textContent = 'Please log in to your account.';
        }
        
        function showRegisterForm() {
            document.getElementById('registerForm').classList.add('active');
            document.getElementById('loginForm').classList.remove('active');
            document.getElementById('popupTitle').textContent = 'Sign Up';
            document.getElementById('popupSubtitle').textContent = 'Create your account to get started.';
        }
        
        function showForgotPassword() {
            alert('Forgot password functionality would be implemented here.');
        }
        
        // Close popup when clicking outside
        document.getElementById('popupOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });
        
        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
                closePopupReplate();
            }
        });
        
        // Notifikasi kalau berhasil
        document.querySelector('#loginForm form').addEventListener('submit', function(e) {
            e.preventDefault();
            createClickParticles(e.submitter);
            setTimeout(() => alert('Login form submitted!'), 300);
        });
        
        document.querySelector('#registerForm form').addEventListener('submit', function(e) {
            e.preventDefault();
            createClickParticles(e.submitter);
            setTimeout(() => alert('Registration form submitted!'), 300);
        });
        
        // Fungsi animasi partikel
        function createClickParticles(button) {
            const rect = button.getBoundingClientRect();
            const particleCount = 12;
            
            for (let i = 0; i < particleCount; i++) {
                createParticle(button, rect);
            }
        }
        
        function createParticle(button, rect) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Random size
            const size = Math.random() * 5 + 3;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            
            // Starts from center (tengah-tengah tombol)
            const startX = rect.width / 2;
            const startY = rect.height / 2;
            
            particle.style.left = startX + 'px';
            particle.style.top = startY + 'px';
            
            // Random direction and distance
            const angle = Math.random() * Math.PI * 2;
            const distance = Math.random() * 80 + 40;
            const dx = Math.cos(angle) * distance;
            const dy = Math.sin(angle) * distance;
            
            particle.style.setProperty('--dx', dx + 'px');
            particle.style.setProperty('--dy', dy + 'px');
            
            button.appendChild(particle);
            
            // Remove particle after animation
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 800);
        }
        
        // Add hover particle effect
        function createHoverParticles(button) {
            if (button.dataset.hovering === 'true') return;
            
            const rect = button.getBoundingClientRect();
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 4 + 2;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.background = 'rgba(255, 255, 255, 0.6)';
            
            const x = Math.random() * rect.width;
            const y = Math.random() * rect.height;
            
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';
            
            const dx = (Math.random() - 0.5) * 30;
            const dy = (Math.random() - 0.5) * 30;
            
            particle.style.setProperty('--dx', dx + 'px');
            particle.style.setProperty('--dy', dy + 'px');
            
            button.appendChild(particle);
            
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 800);
        }
        
        // Add continuous hover particles
        document.querySelectorAll('.submit-btn, .demo-button').forEach(button => {
            let hoverInterval;
            
            button.addEventListener('mouseenter', function() {
                this.dataset.hovering = 'true';
                hoverInterval = setInterval(() => {
                    createHoverParticles(this);
                }, 150);
            });
            
            button.addEventListener('mouseleave', function() {
                this.dataset.hovering = 'false';
                clearInterval(hoverInterval);
            });
        });



        // Initialize all swipers
        document.addEventListener('DOMContentLoaded', function() {
            // Basic Swiper
            const basicSwiper = new Swiper('.basic-swiper', {
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                effect: 'slide',
                speed: 600,
            });
            // Card Swiper
            const swiper = new Swiper('.card-swiper', {
                slidesPerView: 4,
                spaceBetween: 16,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    0: {
                    slidesPerView: 3,
                    },
                    768: {
                    slidesPerView: 4,
                    },
                    1024: {
                    slidesPerView: 4,
                    }
                }
            });
        });



        // Recipe form functionality
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



        // Send replate popup
        function openPopupReplate() {
            document.getElementById('replatePopup').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopupReplate() {
            document.getElementById('replatePopup').classList.remove('active');
            document.body.style.overflow = 'auto';
            resetForm();
        }

        function closePopupOnOverlay(event) {
            if (event.target === event.currentTarget) {
                closePopupReplate();
            }
        }

        function triggerFileInput() {
            document.getElementById('replateImageInput').click();
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 0.3 * 1024 * 1024) {
                    alert('File size must be or less than 300KB');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const container = document.querySelector('.replate-image-upload-container');
                    const preview = document.getElementById('replateImagePreview');
                    const deleteBtn = document.querySelector('.replate-delete-image-btn');
                    const placeholder = document.querySelector('.replate-upload-placeholder');

                    preview.src = e.target.result;
                    preview.classList.add('show');
                    deleteBtn.classList.add('show');
                    placeholder.style.display = 'none';
                    container.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        }

        function deleteImage(event) {
            event.stopPropagation();
            
            const container = document.querySelector('.replate-image-upload-container');
            const preview = document.getElementById('replateImagePreview');
            const deleteBtn = document.querySelector('.replate-delete-image-btn');
            const placeholder = document.querySelector('.replate-upload-placeholder');
            const fileInput = document.getElementById('replateImageInput');

            preview.classList.remove('show');
            deleteBtn.classList.remove('show');
            placeholder.style.display = 'block';
            container.classList.remove('has-image');
            fileInput.value = '';
        }

        function updateCharCount() {
            const textarea = document.getElementById('replateDescriptionText');
            const charCount = document.getElementById('replateCharCount');
            const currentLength = textarea.value.length;
            
            charCount.textContent = `${currentLength} / 500`;
            
            if (currentLength > 450) {
                charCount.style.color = '#dc3545';
            } else if (currentLength > 400) {
                charCount.style.color = '#fd7e14';
            } else {
                charCount.style.color = '#6c757d';
            }
        }

        function submitReplate() {
            const description = document.getElementById('replateDescriptionText').value.trim();
            const imageInput = document.getElementById('replateImageInput');
            
            if (!description) {
                alert('Please add a description for your replate.');
                return;
            }

            if (description.length < 10) {
                alert('Description must be at least 10 characters long.');
                return;
            }

            // Backend di sini
            alert('Replate submitted successfully!');
            closePopupReplate();
        }

        function resetForm() {
            document.getElementById('replateDescriptionText').value = '';
            document.getElementById('replateCharCount').textContent = '0 / 500';
            document.getElementById('replateCharCount').style.color = '#6c757d';
            deleteImage(new Event('click'));
        }

        // Prevent form submission on Enter key in textarea
        document.getElementById('replateDescriptionText').addEventListener('keydown', function(event) {
            if (event.key === 'Enter' && event.ctrlKey) {
                submitReplate();
            }
        });