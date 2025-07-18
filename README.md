# NIMA LOGISTICS - Global Logistics Solutions

A comprehensive logistics website showcasing NIMA LOGISTICS's complete range of international shipping and logistics services.

## 🌟 Features

- **Responsive Design** - Optimized for desktop, tablet, and mobile devices
- **Service Pages** - Detailed information for each logistics service
- **Contact Forms** - Integrated contact and quote request forms
- **Email Integration** - PHP mail() function for automated email responses
- **Modern UI/UX** - Clean, professional design with smooth animations

## 🚀 Services Offered

### Core Logistics Services
- **Air Freight** - Express air shipping with 24-72 hour delivery
- **Ocean Freight** - Cost-effective sea shipping (FCL/LCL)
- **Land Freight** - Regional transportation across East Africa
- **Warehousing** - Secure storage with inventory management
- **Customs Clearance** - Streamlined customs processing
- **Project Logistics** - Specialized handling for complex cargo

### Specialized Solutions
- **Buyers Consolidation** - Multi-supplier shipment consolidation
- **LCL Consolidation & FCL** - Flexible container solutions
- **International Freight & Forwarding** - Complete global logistics

## 📁 Project Structure

```
nima-logistics/
├── 📁 pages/                          # All HTML pages
│   ├── index.html                     # Main homepage
│   ├── about.html                     # About company
│   ├── faq.html                       # Frequently asked questions
│   ├── privacy.html                   # Privacy policy
│   ├── blog.html                      # Company blog

│   └── 📁 services/                   # Service pages
│       ├── airfreight.html
│       ├── oceanfreight.html
│       ├── landfreight.html
│       ├── warehousing.html
│       ├── buyersconsolidation.html
│       ├── customsclearance.html
│       ├── lclconsolidation.html
│       ├── projectlogistics.html
│       └── internationalfreight.html
├── 📁 scripts/                        # JavaScript files
│   └── script.js                      # Main JavaScript functionality
├── 📁 backend/                        # PHP backend files
│   ├── 📁 handlers/                   # Form handlers
│   │   ├── submit_contact.php         # Contact form handler
│   │   ├── submit_contact_smtp.php    # SMTP contact handler
│   │   └── debug_contact.php          # Debug contact handler
│   ├── 📁 tests/                      # Test files
│   │   ├── test_email_send.php        # Email testing
│   │   └── check_logs.php             # Log checking
│   └── 📁 database/                   # Database files
│       └── Nima.sql                   # Database schema
├── 📁 development/                    # Development files
│   ├── 📁 backups/                    # Backup files
│   │   ├── index_backup.html          # Homepage backup
│   │   └── index_restructured.html    # Restructured homepage
│   └── 📁 tests/                      # Development tests
│       ├── test_tabs.html             # Tab testing
│       ├── test_contact_form.html     # Contact form testing
│       ├── css_analysis_report.txt    # CSS analysis
│       └── .hintrc                    # Development config
├── 📁 assets/                         # Images and media
│   ├── nimalogo.jpg                   # Company logo
│   ├── hero.jpg                       # Hero background
│   ├── airfreight.jpg                 # Air freight image
│   ├── oceanfreight.jpg               # Ocean freight image
│   ├── landfreight.jpg                # Land freight image
│   ├── warehouse.jpg                  # Warehousing image
│   ├── buyersconsolidation.jpg        # Buyers consolidation image
│   ├── customsclearance.jpg           # Customs clearance image
│   ├── lclconsolidation.jpg           # LCL consolidation image
│   ├── projectlogistics.jpg           # Project logistics image
│   ├── internationalfreihtandforwading.jpg # International freight image
│   ├── breakbulk.jpg                  # Breakbulk image
│   ├── expressshipping.jpg            # Express shipping image
│   ├── heavycargo.jpg                 # Heavy cargo image
│   ├── temperaturecontrol.jpg         # Temperature control image
│   ├── exportdocumentaion.jpg         # Export documentation image
│   ├── importclearance.jpg            # Import clearance image
│   ├── hscodeclasification.jpg        # HS code classification image
│   └── iclconsolidation.jpg           # ICL consolidation image
├── 📁 styles/                         # CSS stylesheets
│   ├── index.css                      # Main stylesheet
│   ├── about.css                      # About page styles
│   ├── airfreight.css                 # Air freight page styles
│   ├── oceanfreight.css               # Ocean freight page styles
│   └── customsclearance.css           # Customs clearance page styles
├── composer.json                      # Composer configuration
├── composer.lock                      # Composer lock file
├── .gitignore                         # Git ignore rules
└── README.md                          # This file
```

## 🛠️ Technologies Used

### Frontend
- **HTML5** - Semantic markup
- **CSS3** - Modern styling with Flexbox and Grid
- **JavaScript** - Interactive functionality
- **Tailwind CSS** - Utility-first CSS framework
- **Font Awesome** - Icon library

### Backend
- **PHP** - Server-side scripting
- **PHP mail()** - Email functionality
- **MySQL** - Database (schema provided)

### Development Tools
- **Composer** - PHP dependency management
- **Git** - Version control

## 🚀 Getting Started

### Prerequisites
- Web server (Apache/Nginx)
- PHP 7.4 or higher
- MySQL database (optional for admin features)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/nima-logistics.git
   cd nima-logistics
   ```

2. **Configure email settings**
   - Update recipient email in `backend/handlers/submit_contact.php`
   - Update recipient email in `backend/handlers/submit_contact_smtp.php`
   - Configure server mail settings if needed

3. **Set up database (optional)**
   - Import `backend/database/Nima.sql` to your MySQL database
   - Configure database connection in admin files

4. **Configure web server**
   - Point document root to project directory
   - Ensure PHP is enabled
   - Set up URL rewriting if needed

### File Permissions
Ensure the following directories are writable:
- `backend/handlers/` (for form processing)
- `development/` (for logs and backups)

## 📧 Contact Forms

The website includes several contact forms:
- **Main Contact Form** - General inquiries
- **Quote Request Forms** - Service-specific quotes
- **Admin Contact Management** - Backend contact viewing

All forms use PHP mail() function for email delivery.

## 🎨 Customization

### Styling
- Main styles: `styles/index.css`
- Service-specific styles: `styles/[service].css`
- Responsive design included

### Content
- Update company information in HTML files
- Modify service descriptions in respective pages
- Update contact information in footer

### Images
- Replace images in `assets/` directory
- Maintain aspect ratios for optimal display
- Optimize images for web use

## 🔧 Development

### Adding New Services
1. Create new HTML file in `pages/services/`
2. Add service card to homepage
3. Update navigation links
4. Create service-specific CSS if needed

### Backend Development
- Admin panel: `backend/admin/`
- Form handlers: `backend/handlers/`
- Configuration: `backend/config/`

## 📱 Responsive Design

The website is fully responsive with:
- Mobile-first approach
- Touch-friendly navigation
- Optimized images for all devices
- Flexible grid layouts

## 🔒 Security Features

- Form validation and sanitization
- CSRF protection
- Secure email handling
- Input sanitization

## 📊 Performance

- Optimized images
- Minified CSS/JS
- Lazy loading for images
- Efficient asset loading
- Caching-friendly structure

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is proprietary software for NIMA LOGISTICS.

## 📞 Contact

**NIMA LOGISTICS**
- **Phone:** +254 710736123 (Nimrod) / +254 702364009
- **Email:** nimalogisticsltd@gmail.com
- **Address:** JKIA Cargo Terminal, Fourth Season Building, 4th Floor Rm 18, Nairobi - Kenya
- **Website:** nimalogistics.co.ke

---

**Made with ❤️ by Mcave** 
