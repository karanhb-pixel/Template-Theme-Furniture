# Biz-Catalog – Generic Business Catalog & Portfolio Theme

## 📖 Overview

Biz-Catalog is a flexible, reusable WordPress theme designed for businesses that need to showcase their products, services, or projects. Perfect for furniture stores, interior design studios, modular kitchen companies, showrooms, and any catalog-based business. The theme features custom post types, taxonomy support, ACF integration for flexible content management, and WooCommerce compatibility.

🔗 **Live Demo:** [Add your live demo URL here]

📦 **Download:** [https://github.com/yourusername/biz-catalog]

---

## 🚀 Key Features

- **Dynamic Content:** Custom post types for projects with taxonomy-based filtering
- **Custom Post Types (CPT):** Project CPT with Service taxonomy for categorization
- **ACF Integration:** Advanced Custom Fields for flexible content management including contact settings and project galleries
- **WooCommerce Overrides:** Full support for WooCommerce plugin integration
- **Custom Templates:** Front-page, single project, service taxonomy archive, and more
- **Search + Pagination:** Built-in search functionality with pagination support
- **Widget Areas:** Sidebar widget area for additional content
- **Frontend Framework/Styling:** Pure CSS with modern responsive design
- **Reusable Template:** Generic design suitable for any business type
- **Responsive Design:** Mobile-first approach with touch/swipe support
- **Gallery Slider:** Swiper.js integration for project image galleries

---

## 🛠 Tech Stack

**Frontend**
- Pure CSS with modern styling
- HTML5 semantic markup
- JavaScript for interactive elements (Swiper slider, navigation)
- Responsive design with mobile-first approach

**Backend**
- PHP
- WordPress Theme API
- Advanced Custom Fields (ACF)
- Custom Post Types and Taxonomies
- WP_Query for custom content retrieval

**Database**
- MySQL / MariaDB

**Required Plugins**
- Advanced Custom Fields (ACF)
- Contact Form 7 (optional for contact forms)
- WooCommerce (optional for e-commerce functionality)

---

## ⚙️ Template Hierarchy Used

- **front-page.php** – Custom homepage with hero section, services grid, project catalog, and contact form
- **single-project.php** – Single project display with gallery slider, project details, and related projects
- **taxonomy-service.php** – Service category archive showing projects filtered by service type
- **archive-project.php** – Project archive with filtering and sorting
- **archive.php** – Default archive template for post types
- **functions.php** – Theme setup, ACF field groups, custom functions, and enqueue scripts/styles

(*Remove unused items automatically*)

---

## 🔧 Installation

1. Download the repository.
2. Move the theme folder into:

/wp-content/themes/biz-catalog

3. Go to **WordPress Admin → Appearance → Themes**
4. Activate: **Biz-Catalog**
5. Install required plugins:
   - Advanced Custom Fields (ACF)
   - Contact Form 7 (optional)
   - WooCommerce (optional)

## 📋 Quick Start Guide

### 1. Import ACF Field Groups

1. Go to **Custom Fields → Tools** in WordPress admin
2. Click **Import Field Groups**
3. Upload the provided JSON files from `/acf-exports/` directory
4. Import: Site Settings, Service Fields, and Project Details

### 2. Configure Site Settings

1. Go to **Appearance → Site Settings** (ACF Options Page)
2. Fill in your company information, contact details, and section titles
3. Upload hero image and other media
4. Save changes

### 3. Create Services

1. Go to **Projects → Services** (custom taxonomy)
2. Add your service categories (e.g., Living Room, Office, Kitchen)
3. For each service, add:
   - Hero image
   - Short description
   - Optional icon and color

### 4. Add Projects

1. Go to **Projects → Add New** (custom post type)
2. Fill in project title and content
3. Set featured image
4. Assign to a service category
5. Add ACF fields:
   - Gallery images
   - Project specifications
   - Client name, location, year
   - Budget and area
   - Featured flag

### 5. Customize Menu

1. Go to **Appearance → Menus**
2. Create a new menu with:
   - Home
   - Projects (archive)
   - Services (taxonomy archive)
   - Contact
3. Assign to "Primary" menu location

---

## 📸 Screenshots

> Add actual screenshot paths.

### Homepage
<img src="Screenshots/home.png" width="600" alt="Homepage Screenshot">

### Single Project
<img src="Screenshots/project-single.png" width="600" alt="Project Screenshot">

### Thumbnail Screenshot
<img src="Screenshots/thumbnail.png" width="600" alt="Thumbnail Screenshot">

---

## 📝 Author

**Your Name**
WordPress Theme Developer

🔗 Portfolio: [https://your-portfolio-url.com/]
🔗 LinkedIn: [https://www.linkedin.com/in/your-profile/]

---

## 📄 License

This project is licensed under the **GPL-2.0** license.
See the `LICENSE.md` file for details.

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Create a new Pull Request

## 📞 Support

For support or questions, please:
- Open an issue on GitHub
- Visit our [website](https://yourwebsite.com)
- Contact: support@yourdomain.com

## 🎯 Use Cases

This theme is perfect for:
- **Furniture Stores** - Showcase your products and showrooms
- **Interior Design Studios** - Display your design projects
- **Modular Kitchen Companies** - Present your kitchen designs
- **Showrooms** - Create virtual showroom experiences
- **Any Catalog-Based Business** - Showcase your products/services

## 🚀 Publishing Checklist

Before publishing to GitHub or theme marketplace:

- [ ] Remove all environment-specific URLs
- [ ] Update screenshots with generic imagery
- [ ] Test on multiple WordPress versions
- [ ] Test with different plugins
- [ ] Create ACF export files
- [ ] Write comprehensive documentation
- [ ] Add .gitignore file
- [ ] Add .editorconfig for code style
- [ ] Create CHANGELOG.md
- [ ] Create CONTRIBUTING.md
- [ ] Create CODE_OF_CONDUCT.md
