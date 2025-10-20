// ============================================
// FLIGHT BOOKING LANDING PAGE - JAVASCRIPT
// ============================================

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
    
    // ============================================
    // DATE INPUT CONFIGURATION
    // ============================================
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
    
    // Update return date min when departure date changes
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
    
    // ============================================
    // TAB SWITCHING WITH ANIMATION
    // ============================================
    const tabs = document.querySelectorAll('.search-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(102, 126, 234, 0.3);
                width: 100px;
                height: 100px;
                animation: ripple 0.6s ease-out;
                pointer-events: none;
            `;
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
    
    // ============================================
    // FLIGHT TABS SWITCHING
    // ============================================
    const flightTabs = document.querySelectorAll('.flight-tab');
    flightTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            flightTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // ============================================
    // DEAL CARDS CLICK ANIMATION
    // ============================================
    const dealCards = document.querySelectorAll('.deal-card');
    dealCards.forEach(card => {
        card.addEventListener('click', function() {
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
                // Use the route from data attribute or default
                const route = this.getAttribute('data-route') || '/flights';
                window.location.href = route;
            }, 150);
        });
    });
    
    // ============================================
    // PROMO CARDS CLICK TO COPY
    // ============================================
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
    
    // ============================================
    // ANIMATE ELEMENTS ON SCROLL
    // ============================================
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
    
    // Observe feature cards, deal cards, and destination cards
    const animatedElements = document.querySelectorAll('.feature-card, .deal-card, .destination-card, .benefit-card');
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
    
    // ============================================
    // HOVER EFFECTS
    // ============================================
    const interactiveElements = document.querySelectorAll('.search-button, .btn-book, .deal-card, .promo-card');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
    
    // ============================================
    // SEARCH FORM LOADING ANIMATION
    // ============================================
    const searchForm = document.querySelector('.search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const button = this.querySelector('.search-button');
            if (button) {
                const originalText = button.innerHTML;
                button.innerHTML = `
                    <div class="loading-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    Đang tìm kiếm...
                `;
                button.disabled = true;
                button.style.opacity = '0.8';
            }
        });
    }
});

// ============================================
// COPY TO CLIPBOARD FUNCTION
// ============================================
function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text);
    } else {
        // Fallback for older browsers
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

// ============================================
// COPY PROMO CODE FROM BANNER
// ============================================
function copyPromoCode() {
    const input = document.getElementById('promoCodeInput');
    if (input) {
        const code = input.value;
        copyToClipboard(code);
        showToast(`✅ Đã sao chép ${code}`);
        
        // Button animation
        const btn = event.target;
        if (btn) {
            btn.innerHTML = '✓ Đã Copy';
            btn.style.background = '#10b981';
            setTimeout(() => {
                btn.innerHTML = 'Copy';
                btn.style.background = '#fbbf24';
            }, 2000);
        }
    }
}

// ============================================
// SHOW TOAST NOTIFICATION
// ============================================
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

// ============================================
// RIPPLE ANIMATION STYLE
// ============================================
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(rippleStyle);

// ============================================
// PARALLAX EFFECT FOR HERO SECTION
// ============================================
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const heroSection = document.querySelector('.hero-section');
    if (heroSection && scrolled < window.innerHeight) {
        heroSection.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// ============================================
// SMOOTH SCROLL FOR INTERNAL LINKS
// ============================================
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

// ============================================
// ANIMATE NUMBERS (COUNTING ANIMATION)
// ============================================
function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        element.innerHTML = Math.floor(progress * (end - start) + start).toLocaleString('vi-VN');
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// ============================================
// KEYBOARD NAVIGATION
// ============================================
document.addEventListener('keydown', function(e) {
    // Press "/" to focus search
    if (e.key === '/' && !e.target.matches('input, textarea')) {
        e.preventDefault();
        const fromInput = document.querySelector('input[name="from"]');
        if (fromInput) {
            fromInput.focus();
        }
    }
});

// ============================================
// LAZY LOAD IMAGES (PERFORMANCE OPTIMIZATION)
// ============================================
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ============================================
// MOUSE TRAIL EFFECT (OPTIONAL)
// ============================================
let mouseTrail = [];
document.addEventListener('mousemove', function(e) {
    if (mouseTrail.length > 20) {
        const oldTrail = mouseTrail.shift();
        if (oldTrail) {
            oldTrail.remove();
        }
    }
    
    // Only add trail on specific elements for performance
    if (e.target.closest('.hero-section')) {
        const trail = document.createElement('div');
        trail.style.cssText = `
            position: fixed;
            width: 5px;
            height: 5px;
            background: rgba(102, 126, 234, 0.3);
            border-radius: 50%;
            pointer-events: none;
            left: ${e.clientX}px;
            top: ${e.clientY}px;
            animation: trailFade 1s ease-out forwards;
            z-index: 9999;
        `;
        document.body.appendChild(trail);
        mouseTrail.push(trail);
    }
});

// ============================================
// TRAIL FADE ANIMATION
// ============================================
const trailStyle = document.createElement('style');
trailStyle.textContent = `
    @keyframes trailFade {
        0% {
            opacity: 1;
            transform: scale(1);
        }
        100% {
            opacity: 0;
            transform: scale(0);
        }
    }
`;
document.head.appendChild(trailStyle);

// ============================================
// LOADING DOTS ANIMATION STYLE
// ============================================
const loadingStyle = document.createElement('style');
loadingStyle.textContent = `
    .loading-dots {
        display: inline-flex;
        gap: 0.25rem;
    }
    
    .loading-dots span {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
        animation: loadingDot 1.4s infinite ease-in-out;
    }
    
    .loading-dots span:nth-child(1) { animation-delay: 0s; }
    .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
    .loading-dots span:nth-child(3) { animation-delay: 0.4s; }
    
    @keyframes loadingDot {
        0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
        40% { transform: scale(1); opacity: 1; }
    }
`;
document.head.appendChild(loadingStyle);

// ============================================
// CONSOLE MESSAGE (OPTIONAL)
// ============================================
console.log('%c🛫 Flight Booking System Loaded Successfully!', 'color: #667eea; font-size: 16px; font-weight: bold;');
console.log('%cDeveloped with ❤️', 'color: #764ba2; font-size: 12px;');