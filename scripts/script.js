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

    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
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
            if (targetPanel) {
                targetPanel.classList.add('active');
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

    // EmailJS Contact Form Integration

    // EmailJS contact form handler
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = `<span class="loading-spinner"></span> Sending...`;
        submitBtn.disabled = true;

        const params = {
          name: document.getElementById('name').value,
          email: document.getElementById('email').value,
          subject: 'Contact Form',
          message: document.getElementById('message').value,
        };

        emailjs.send('service_2m20d84', 'template_gnjktm4', params)
          .then(function(response) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            alert('Message sent! We will contact you shortly.');
            contactForm.reset();
          }, function(error) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            alert('Failed to send message. Please try again later.');
          });
      });
    }

    // Navigation toggle and sticky header
const navToggle = document.querySelector('.nav-toggle');
const mainNav = document.querySelector('.main-nav');
const header = document.querySelector('.header');
const navLinksMobile = document.querySelectorAll('.main-nav a');

    if (navToggle && mainNav) {
navToggle.addEventListener('click', () => {
  mainNav.classList.toggle('active');
  document.body.classList.toggle('nav-open');
});
// Auto-close menu on link click (mobile)
navLinksMobile.forEach(link => {
  link.addEventListener('click', () => {
    if (mainNav.classList.contains('active')) {
      mainNav.classList.remove('active');
      navToggle.classList.remove('active');
      document.body.classList.remove('nav-open');
    }
  });
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
// Scroll reveal
const reveals = document.querySelectorAll('.reveal');

const observer = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if (e.isIntersecting) e.target.classList.add('show');
  });
}, { threshold: 0.1 });

reveals.forEach(el => observer.observe(el));

// Filter
const filters = document.querySelectorAll('.filter');
const cards = document.querySelectorAll('.merch-card');

filters.forEach(btn => {
  btn.addEventListener('click', () => {
    filters.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const type = btn.dataset.filter;
    cards.forEach(card => {
      card.style.display =
        type === 'all' || card.dataset.category === type
          ? 'block'
          : 'none';
    });
  });
});
const filters = document.querySelectorAll(".filter");
const cards = document.querySelectorAll(".merch-card");

/* FILTERING */
filters.forEach(btn => {
  btn.addEventListener("click", () => {
    filters.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    cards.forEach(card => {
      card.style.display =
        btn.dataset.filter === "all" ||
        card.dataset.category === btn.dataset.filter
          ? "block"
          : "none";
    });
  });
});

/* MODAL */
const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");
const modalTitle = document.getElementById("modalTitle");
const modalDesc = document.getElementById("modalDesc");
const modalMaterial = document.getElementById("modalMaterial");
const modalUse = document.getElementById("modalUse");
const closeBtn = document.querySelector(".close");

cards.forEach(card => {
  card.addEventListener("click", () => {
    modalImg.src = card.querySelector("img").src;
    modalTitle.textContent = card.querySelector("h3").textContent;
    modalDesc.textContent = card.querySelector("p").textContent;
    modalMaterial.textContent = card.dataset.material;
    modalUse.textContent = card.dataset.use;
    modal.classList.add("show");
  });
});

closeBtn.onclick = () => modal.classList.remove("show");
modal.onclick = e => e.target === modal && modal.classList.remove("show");

