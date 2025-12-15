# Biz-Catalog – Generic Business Catalog & Portfolio WordPress Theme

## 📖 Overview

Biz-Catalog is a reusable, production-ready WordPress theme built for businesses that need to showcase projects, products, or services in a clean, structured way.

Originally developed as a furniture catalog site, the theme was refactored into an industry-agnostic template suitable for multiple business domains.

The theme follows WordPress coding standards and focuses on **scalability, admin usability, and performance**. Features **marketplace-ready architecture** with comprehensive ACF field management and modular template structure.

Ideal for: furniture stores, interior design studios, showrooms, architecture firms, service-based businesses, and portfolio websites.

🔗 **Live Demo:** Coming Soon  
📦 **Repository:** https://github.com/yourusername/biz-catalog

---

## 🚀 Key Features

### **Custom Post Types**
- **Projects** (portfolio/catalog items)
- **Optional Products** support

### **Custom Taxonomies** 
- **Service taxonomy** for structured categorization

### **Advanced Custom Fields (ACF)**
- Fully editable site settings (branding, hero, contact info)
- Project galleries, specifications, metadata
- Complete JSON export coverage for marketplace deployment

### **Reusable Template Architecture**
- Industry-agnostic placeholders
- Context-aware templates

### **Responsive & Mobile-First Design**
- Built with modern CSS (Grid & Flexbox)

### **Search & Pagination**
- Custom queries using WP_Query

### **Gallery Slider**
- Swiper.js integration for image galleries

### **WooCommerce Compatibility**
- Optional WooCommerce overrides for catalog/eCommerce use

### **Accessibility & Performance Focused**
- Clean markup, optimized assets, minimal dependencies

---

## 🛠 Tech Stack

### **Frontend**
- HTML5 (semantic markup)
- CSS3 (Grid, Flexbox, CSS Variables)
- JavaScript (navigation, sliders)

### **Backend**
- PHP
- WordPress Theme API
- Advanced Custom Fields (ACF)
- Custom Post Types & Taxonomies
- WP_Query

### **Database**
- MySQL / MariaDB

### **Recommended Plugins**
- Advanced Custom Fields (ACF)
- Contact Form 7 (optional)
- WooCommerce (optional)

---

## ⚙️ WordPress Template Hierarchy

- **front-page.php** – Custom homepage (hero, services, projects, contact)
- **single-project.php** – Single project view with gallery & details
- **taxonomy-service.php** – Service-based project archive
- **archive-project.php** – Project listing with pagination
- **page.php, archive.php, 404.php**
- **functions.php** – Theme setup, CPTs, taxonomies, scripts, utilities

---

## 🔧 Installation

1. **Clone or download the repository**

2. **Copy the theme to:**
   ```
   /wp-content/themes/biz-catalog
   ```

3. **Go to WordPress Admin → Appearance → Themes**

4. **Activate Biz-Catalog**

5. **Install required plugins:**
   - Advanced Custom Fields (ACF)
   - Contact Form 7 (optional)
   - WooCommerce (optional)

---

## 📋 Quick Start

### 1️⃣ **Import ACF Field Groups**

Go to **Custom Fields → Tools**

Import JSON files from `/acf-exports/`

Import:
- **Site Settings**
- **Service Fields** 
- **Project Details**
- **Product Details** *(optional)*

### 2️⃣ **Configure Site Settings**

Go to **Appearance → Site Settings**

Add:
- Logo & branding
- Hero content
- Contact details
- Footer content

**Theme Options Page:**  
![Theme Options Screenshot](Screenshots/theme-options.png)

### 3️⃣ **Create Services**

Navigate to **Projects → Services**

Add service categories (e.g., Living Room, Office, Kitchen)

Configure service-specific fields (image, description, icon)

### 4️⃣ **Add Projects**

Go to **Projects → Add New**

Assign service taxonomy

Fill in ACF fields:
- Gallery
- Specifications
- Client info
- Budget, year, location
- Featured project flag

### 5️⃣ **Customize Menu**

Go to **Appearance → Menus**

Create menu with:
- Home
- Projects (archive)
- Services (taxonomy archive)  
- Contact

Assign to "Primary" menu location

---

## 📸 Screenshots

### Homepage
![Homepage](Screenshots/home.png)

### Single Project
![Project Details](Screenshots/project-single.png)

### Archive View
![Archive](Screenshots/archive.png)

### Theme Options Page
![Theme Options](Screenshots/theme-options.png)

### Thumbnail
![Thumbnail](Screenshots/thumbnail.png)

---

## 🧑‍💻 Author

**Karan Bhanushali**  
WordPress Theme Developer

🔗 **Portfolio:** https://your-portfolio-url.com  
🔗 **LinkedIn:** https://www.linkedin.com/in/your-profile

---

## 📄 License

Licensed under the **GPL-2.0** license.  
See `LICENSE.md` for details.

---

## 🤝 Contributing

Contributions are welcome.

1. **Fork the repository**
2. **Create a feature branch**
3. **Commit changes**
4. **Submit a pull request**

---

## 🎯 Use Cases

- **Furniture & showroom websites**
- **Interior design portfolios**
- **Service-based business websites**
- **Project & case-study showcases**
- **Generic catalog-style websites**

---

## 🚀 Publishing Checklist

- [ ] Replace demo content with generic data
- [ ] Add real screenshots
- [ ] Verify ACF JSON exports *(✅ Complete)*
- [ ] Test on latest WordPress versions
- [ ] Test with WooCommerce enabled/disabled
- [ ] Add CHANGELOG.md *(✅ Complete)*
- [ ] Add .editorconfig *(✅ Complete)*
- [ ] Finalize README and demo URL

---

## 🏗 Marketplace-Ready Architecture

This theme is built with **marketplace deployment** in mind:

- **Complete ACF field coverage** - All field groups exported as JSON
- **Generic, reusable design** - Not tied to specific industries
- **WordPress coding standards** - Follows all WP best practices
- **Comprehensive documentation** - Easy setup and customization
- **Performance optimized** - Fast loading and SEO-friendly
- **Accessibility compliant** - WCAG guidelines followed
- **Plugin compatibility** - Works with popular WP plugins
- **Mobile-first responsive** - Works on all devices

**Ready for submission to:**
- WordPress.org Theme Directory
- ThemeForest marketplace
- Other premium theme marketplaces
