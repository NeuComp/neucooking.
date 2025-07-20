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