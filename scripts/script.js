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

// Enhanced Filter and Search Functionality
const filters = document.querySelectorAll('.filter');
const cards = document.querySelectorAll('.merch-card');
const searchInput = document.getElementById('searchInput');
const productCount = document.getElementById('productCount');
const countText = document.getElementById('countText');
const merchGrid = document.getElementById('merchGrid');
let currentFilter = 'all';
let currentSearch = '';

// Update product count
function updateProductCount() {
  const visibleCards = Array.from(cards).filter(card => 
    !card.classList.contains('hidden')
  );
  const total = cards.length;
  const visible = visibleCards.length;
  
  if (visible === 0) {
    if (!document.querySelector('.no-results')) {
      const noResults = document.createElement('div');
      noResults.className = 'no-results';
      noResults.innerHTML = `
        <span class="no-results-icon">🔍</span>
        <h3>No products found</h3>
        <p>Try adjusting your search or filter criteria</p>
      `;
      merchGrid.appendChild(noResults);
    }
    countText.innerHTML = `Showing <strong>0</strong> of <strong>${total}</strong> products`;
  } else {
    const noResults = document.querySelector('.no-results');
    if (noResults) noResults.remove();
    countText.innerHTML = `Showing <strong>${visible}</strong> of <strong>${total}</strong> products`;
  }
}

// Filter and search function
function filterAndSearch() {
  cards.forEach(card => {
    const category = card.dataset.category;
    const name = (card.dataset.name || '').toLowerCase();
    const tags = (card.dataset.tags || '').toLowerCase();
    const material = (card.dataset.material || '').toLowerCase();
    const use = (card.dataset.use || '').toLowerCase();
    
    // Check category filter
    const categoryMatch = currentFilter === 'all' || category === currentFilter;
    
    // Check search query
    const searchLower = currentSearch.toLowerCase();
    const searchMatch = !currentSearch || 
      name.includes(searchLower) || 
      tags.includes(searchLower) ||
      material.includes(searchLower) ||
      use.includes(searchLower);
    
    // Show/hide card
    if (categoryMatch && searchMatch) {
      card.classList.remove('hidden');
      card.style.display = 'block';
    } else {
      card.classList.add('hidden');
      card.style.display = 'none';
    }
  });
  
  updateProductCount();
}

// Filter button handlers
filters.forEach(btn => {
  btn.addEventListener('click', () => {
    filters.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    currentFilter = btn.dataset.filter;
    filterAndSearch();
  });
});

// Search input handler
if (searchInput) {
  searchInput.addEventListener('input', (e) => {
    currentSearch = e.target.value.trim();
    filterAndSearch();
  });
}

// Initialize product count
if (cards.length > 0) {
  updateProductCount();
}

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
    const img = card.querySelector("img");
    modalImg.src = img.src;
    modalImg.alt = img.alt;
    modalTitle.textContent = card.querySelector("h3").textContent;
    modalDesc.textContent = card.querySelector("p").textContent;
    modalMaterial.textContent = card.dataset.material;
    modalUse.textContent = card.dataset.use;
    modal.classList.add("show");
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
  });
});

if (closeBtn) {
  closeBtn.onclick = () => {
    modal.classList.remove("show");
    document.body.style.overflow = ''; // Restore scrolling
  };
}

if (modal) {
  modal.onclick = e => {
    if (e.target === modal) {
      modal.classList.remove("show");
      document.body.style.overflow = ''; // Restore scrolling
    }
  };
}

// Close modal on Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && modal && modal.classList.contains('show')) {
    modal.classList.remove("show");
    document.body.style.overflow = '';
  }
});

// Hero Slideshow Functionality
const heroSlides = document.querySelectorAll('.hero-slide');
const heroIndicators = document.querySelectorAll('.hero-indicators .indicator');
let currentSlide = 0;
let slideInterval;

function showSlide(index) {
  // Remove active class from all slides and indicators
  heroSlides.forEach(slide => slide.classList.remove('active'));
  heroIndicators.forEach(indicator => indicator.classList.remove('active'));
  
  // Add active class to current slide and indicator
  if (heroSlides[index]) {
    heroSlides[index].classList.add('active');
  }
  if (heroIndicators[index]) {
    heroIndicators[index].classList.add('active');
  }
  
  currentSlide = index;
}

function nextSlide() {
  const next = (currentSlide + 1) % heroSlides.length;
  showSlide(next);
}

function startSlideshow() {
  // Change slide every 5 seconds
  slideInterval = setInterval(nextSlide, 5000);
}

function stopSlideshow() {
  clearInterval(slideInterval);
}

// Initialize slideshow
if (heroSlides.length > 0) {
  // Show first slide
  showSlide(0);
  
  // Start automatic slideshow
  startSlideshow();
  
  // Pause on hover (optional - uncomment if desired)
  const hero = document.querySelector('.hero');
  if (hero) {
    hero.addEventListener('mouseenter', stopSlideshow);
    hero.addEventListener('mouseleave', startSlideshow);
  }
  
  // Indicator click handlers
  heroIndicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      stopSlideshow();
      showSlide(index);
      startSlideshow();
    });
  });
}

