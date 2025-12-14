# ⭐ **LLM PROMPT: Convert Custom-Catalog WordPress Theme into a Reusable Template**

You are a senior WordPress developer and technical architect.

Your task is to **convert the existing Custom-Catalog theme** into a **reusable, industry-agnostic template** suitable for:
- Furniture stores
- Interior design studios
- Modular kitchen companies
- Showrooms
- Similar informational / catalog-based businesses

The final output should be a **starter theme / template** that can be cloned and reused for new projects with minimal effort.

---

## 🎯 **Overall Goals**

- Make the theme **generic, reusable, and scalable**
- Remove business-specific branding (MR Furniture references)
- Centralize content management via **ACF**
- Ensure clean template hierarchy
- Prepare the project for **publishing (GitHub / portfolio / distribution)**

---

## 🧱 **1. Theme Refactoring & Naming**

Convert the existing project into a generic theme:

### Required Changes:

1. **Rename theme folder and files**:
   - Rename from `custom-catalog` to `biz-catalog` (or similar generic name)
   - Update all references in:
     - `style.css` (Theme Name, Text Domain)
     - `functions.php` (text domain, function names)
     - `README.md` (all references)
     - `readme.txt` (WordPress theme metadata)
     - Language files (`.pot` files)

2. **Update branding elements**:
   - Replace "MR Furniture" with "Your Company Name" placeholder
   - Replace "Interior Designing & Modular Furniture" with generic "Business Services"
   - Replace all hardcoded phone/email/address with ACF fields
   - Replace placeholder images with neutral business imagery

3. **Update screenshots**:
   - Replace `Screenshots/home.png`, `Screenshots/project-single.png`, `Screenshots/thumbnail.png`
   - Use generic business/furniture/interior design imagery

---

## 🧩 **2. Data Architecture (ACF as Single Source of Truth)**

Ensure **no hardcoded content** exists in templates.

### A. Global Settings (ACF Options Page)

The theme already has a **Site Settings** ACF Options Page. **Keep and enhance it**:

**Current Fields (keep these):**
- `contact_phone` (text)
- `contact_email` (email)
- `contact_address` (textarea)
- `contact_whatsapp` (text)
- `contact_form_shortcode` (text)

**Add these new fields:**
- `company_name` (text) - "Your Company Name"
- `company_tagline` (text) - "Transforming Spaces. Crafting Futures."
- `hero_title` (text) - Main hero heading
- `hero_subtitle` (textarea) - Hero description
- `hero_image` (image) - Hero background image
- `footer_copyright` (textarea) - Copyright text
- `about_content` (textarea) - About section content
- `about_facts` (repeater) - Key facts (label + value pairs)

### B. Custom Post Type

**CPT: project** - Already exists, **keep as-is**

- Used for portfolio / catalog items
- Supports: title, content, featured image
- Public archive enabled

### C. Taxonomy

**Taxonomy: service** - Already exists, **keep as-is**

- Assigned to `project`
- Hierarchical
- Used as categories (e.g., Living Room, Office, Kitchen)

### D. ACF Fields – Service (Taxonomy Term)

**Field Group: Service Fields** - Already exists, **keep and enhance**:

**Current Fields (keep these):**
- `service_image` (image, array return) → Hero banner for service archive
- `service_short_description` (textarea)

**Add these new fields:**
- `service_icon` (image) - Optional icon for service
- `service_color` (color picker) - Accent color for service

### E. ACF Fields – Project

**Field Group: Project Details** - **Create this new group**

**Required Fields:**
- `gallery_images` (gallery) - Project image gallery
- `project_specs` (repeater) - label + value pairs for specifications
- `project_featured` (true/false) - Featured project flag
- `project_client_name` (text) - Client name
- `project_location` (text) - Project location
- `project_year` (number) - Completion year
- `project_budget` (text) - Budget range (optional)
- `project_area` (text) - Area in sq.ft or sq.m

---

## 🎨 **3. Template Requirements**

### `front-page.php`

**Current structure (keep and enhance):**
- Hero section (use ACF fields for dynamic content)
- Services grid (taxonomy terms)
- Latest projects grid
- Contact section (uses ACF options)
- About section (use ACF fields)

**Required improvements:**
- Replace hardcoded hero text with ACF fields
- Replace hardcoded about content with ACF fields
- Add featured projects section (filter by `project_featured`)
- Make all sections optional via ACF

### `taxonomy-service.php`

**Current structure (keep and enhance):**
- Dynamic hero banner using `service_image`
- Fallback placeholder if image not set
- Service name + description
- Grid of related projects
- Breadcrumbs

**Required improvements:**
- Add service icon display
- Add service color theming
- Improve empty state handling
- Add "All Services" link back to archive

### `single-project.php`

**Current structure (keep and enhance):**
- Hero using featured image
- Project overview
- ACF project details
- Image gallery slider (Swiper.js)
- Related projects (same service)
- Sidebar metadata
- Breadcrumbs

**Required improvements:**
- Display all ACF fields in a structured layout
- Add project specs table
- Add client information
- Add location and year metadata
- Improve gallery slider initialization (already well-implemented)
- Add print-friendly CSS option

### `archive-project.php`

**Create this new template** (currently uses `archive.php`)

**Required features:**
- Paginated project grid
- Service filter tabs
- Sorting options (newest, featured, alphabetical)
- Consistent card layout
- Featured projects highlighted
- Search functionality

---

## 🎞️ **4. Gallery Slider Requirements**

**Current implementation (keep and enhance):**
- Uses **Swiper.js** (CDN loaded)
- Stable inside grid layouts
- No image stretching
- No blank slides
- Loop only if more than one image
- Fixed slide height with `object-fit: cover`

**Required improvements:**
- Add lightbox functionality for gallery images
- Improve error handling for missing images
- Add lazy loading for gallery images
- Add keyboard navigation support
- Add touch/swipe support for mobile
- Ensure CSS conflicts are avoided

---

## 🧭 **5. Navigation & UX Rules**

**Current implementation (keep and enhance):**
- Breadcrumbs system already implemented
- Anchor links work from any page

**Required improvements:**
- Add scroll-to-top button
- Add back-to-top links on long pages
- Improve mobile menu UX
- Add aria-labels for accessibility
- Add skip-to-content link
- Ensure all links use `home_url()` instead of hardcoded paths

**Breadcrumb structure:**
```
Home / Projects / Service / Project Title
```

---

## 📦 **6. Reusability Workflow**

The template should support this workflow:

1. Clone theme folder
2. Install ACF plugin
3. Import ACF JSON field groups (provide export file)
4. Set Theme Settings (ACF Options Page)
5. Create Services (taxonomy terms with ACF fields)
6. Add Projects (CPT with ACF fields)
7. Publish

**No code changes required for basic usage.**

---

## 📄 **7. Documentation (README.md)**

**Current README (enhance and update):**

**Required sections:**
- Theme description (generic, not MR Furniture specific)
- Use cases (furniture, interior design, showrooms, etc.)
- Tech stack (PHP, WordPress, ACF, Swiper.js, etc.)
- Folder structure explanation
- Quick start steps with screenshots
- ACF import instructions
- Customization guide
- Troubleshooting section
- Screenshots section (updated with generic images)
- License information (GPL-2.0)

**Remove:**
- All MR Furniture specific references
- Environment-specific URLs
- Cache plugin recommendations (optional)

---

## 🚀 **8. Publishing Preparation**

Ensure the theme is ready for:
- GitHub (open source / portfolio)
- Personal website demo
- Future theme marketplaces

**Required actions:**

### Remove:
- Environment-specific URLs
- Cache files (`.cache/`, `node_modules/`)
- Upload references to specific company
- Local development artifacts

### Include:
- Clean, well-commented code
- Consistent naming conventions
- ACF JSON export files
- Screenshot placeholders
- Comprehensive README
- `.gitignore` file
- `.editorconfig` for code style
- `style.css` with proper headers

### GitHub-specific:
- `.github/ISSUE_TEMPLATE/` for bug reports
- `CONTRIBUTING.md` guidelines
- `CHANGELOG.md` (initial version)
- `CODE_OF_CONDUCT.md`

---

## ✅ **Expected Output from LLM**

The LLM should produce:

1. **Refactoring guidance**
   - Step-by-step migration path
   - File renaming strategy
   - Search/replace operations needed

2. **Final ACF structure**
   - JSON export files for all field groups
   - Field group organization
   - Location rules

3. **Template logic overview**
   - How each template should work
   - Conditional logic for optional sections
   - Fallback mechanisms

4. **Reusability strategy**
   - How to make templates flexible
   - How to handle different business types
   - Customization hooks

5. **Documentation outline**
   - Complete README structure
   - Screenshot requirements
   - Installation guide

6. **Publishing checklist**
   - Pre-launch validation steps
   - GitHub repository setup
   - Theme marketplace requirements

---

## 🔍 **Specific Code Analysis**

Based on the current codebase analysis:

### Current Strengths:
- ✅ ACF Options Page already implemented
- ✅ Contact settings centralized
- ✅ Swiper.js gallery working
- ✅ Breadcrumbs implemented
- ✅ Responsive design
- ✅ Custom post type and taxonomy
- ✅ Placeholder images used

### Areas Needing Improvement:
- ⚠️ Hardcoded "MR Furniture" references throughout
- ⚠️ Hardcoded hero text and about content
- ⚠️ No archive-project.php template
- ⚠️ Limited project metadata display
- ⚠️ No featured project system
- ⚠️ No sorting/filtering on archive

---

## 🎯 **Implementation Priority**

1. **Phase 1: Theme Renaming & Branding**
   - Rename all files and references
   - Replace hardcoded content with ACF fields

2. **Phase 2: ACF Structure Enhancement**
   - Add missing fields to options page
   - Create project details field group
   - Enhance service fields

3. **Phase 3: Template Improvements**
   - Create archive-project.php
   - Enhance front-page.php with ACF
   - Improve single-project.php layout

4. **Phase 4: Documentation & Publishing**
   - Update README.md
   - Create ACF export files
   - Prepare GitHub repository

---

# 🔚 **END OF PROMPT**

---

## 📝 **Additional Notes**

This prompt is designed to be **copy-paste ready** for an LLM. It provides:
- Clear, actionable steps
- Specific technical requirements
- Current state analysis
- Expected output structure
- Implementation priority

The resulting template will be **production-ready** and suitable for:
- Personal portfolio projects
- Client work
- Theme marketplace distribution
- Open source contributions
