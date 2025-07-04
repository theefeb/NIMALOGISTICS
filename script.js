// Form handling
document.addEventListener('DOMContentLoaded', function() {
    // Highlight active nav link
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active-link'));
            this.classList.add('active-link');
        });
    });

    // Form submission handling
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading state
            submitBtn.innerHTML = `<span class="loading-spinner"></span> Processing...`;
            submitBtn.disabled = true;

            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 1500));

            // Reset form
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            alert('Request received! We will contact you shortly.');
            if(form.classList.contains('booking-form') || form.classList.contains('contact-form')) {
                form.reset();
            }
        });
    });

    // Navigation toggle and sticky header
    const navToggle = document.querySelector('.nav-toggle');
    const mainNav = document.querySelector('.main-nav');
    const header = document.querySelector('.header');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', () => {
            mainNav.classList.toggle('active');
            document.body.classList.toggle('nav-open');
        });
    }

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
});
