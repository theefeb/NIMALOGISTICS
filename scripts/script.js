// Form handling
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing scripts...');
    
    // Highlight active nav link
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active-link'));
            this.classList.add('active-link');
        });
    });

    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    console.log('Found tab buttons:', tabButtons.length);
    console.log('Found tab panels:', tabPanels.length);

    tabButtons.forEach((button, index) => {
        console.log(`Adding click listener to button ${index}:`, button.textContent);
        button.addEventListener('click', function() {
            console.log('Tab button clicked:', this.textContent);
            const targetTab = this.getAttribute('data-tab');
            console.log('Target tab:', targetTab);
            
            // Remove active class from all buttons and panels
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.style.background = '#e5e7eb';
                btn.style.color = '#374151';
            });
            tabPanels.forEach(panel => {
                panel.classList.remove('active');
            });
            
            // Add active class to clicked button and show target panel
            this.classList.add('active');
            this.style.background = '#3b82f6';
            this.style.color = 'white';
            
            const targetPanel = document.getElementById(targetTab);
            console.log('Target panel found:', targetPanel);
            if (targetPanel) {
                targetPanel.classList.add('active');
            } else {
                console.error('Target panel not found for:', targetTab);
            }
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
