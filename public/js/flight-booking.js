       // Scroll Progress Bar
        window.addEventListener('scroll', function() {
            const scrollProgress = document.getElementById('scrollProgress');
            if (scrollProgress) {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercentage = (scrollTop / scrollHeight) * 100;
                scrollProgress.style.width = scrollPercentage + '%';
            }
        });

        // DOM Content Loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Date input configuration
            const today = new Date().toISOString().split('T')[0];
            const departureDateInput = document.querySelector('input[name="departure_date"]');
            const returnDateInput = document.querySelector('input[name="return_date"]');
            
            if (departureDateInput) {
                departureDateInput.setAttribute('min', today);
                departureDateInput.value = today;
            }
            
            if (returnDateInput) {
                returnDateInput.setAttribute('min', today);
            }
            
            if (departureDateInput) {
                departureDateInput.addEventListener('change', function() {
                    if (returnDateInput) {
                        returnDateInput.setAttribute('min', this.value);
                        if (returnDateInput.value && returnDateInput.value < this.value) {
                            returnDateInput.value = '';
                        }
                    }
                });
            }
            
            // Tab switching
            const tabs = document.querySelectorAll('.search-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            const flightTabs = document.querySelectorAll('.flight-tab');
            flightTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    flightTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Promo cards click to copy
            const promoCards = document.querySelectorAll('.promo-card');
            promoCards.forEach(card => {
                card.addEventListener('click', function() {
                    const code = this.getAttribute('data-code');
                    if (code) {
                        copyToClipboard(code);
                        showToast(`✅ Đã sao chép mã ${code}`);
                    }
                });
            });
            
            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            const animatedElements = document.querySelectorAll('.feature-card, .deal-card, .destination-card, .benefit-card');
            animatedElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
        });

        // Copy to clipboard function
        function copyToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text);
            } else {
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                } catch (err) {
                    console.error('Failed to copy:', err);
                }
                document.body.removeChild(textArea);
            }
        }

        // Copy promo code from banner
        function copyPromoCode() {
            const input = document.getElementById('promoCodeInput');
            if (input) {
                const code = input.value;
                copyToClipboard(code);
                showToast(`✅ Đã sao chép ${code}`);
                
                const btn = event.target;
                if (btn) {
                    btn.innerHTML = '✓ Đã Copy';
                    btn.style.background = '#10b981';
                    setTimeout(() => {
                        btn.innerHTML = 'Copy';
                        btn.style.background = '#ef4444';
                    }, 2000);
                }
            }
        }

        // Show toast notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.innerHTML = `
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Parallax effect for hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroSection = document.querySelector('.hero-section');
            if (heroSection && scrolled < window.innerHeight) {
                heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });