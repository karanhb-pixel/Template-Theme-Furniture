# Contributing to Biz-Catalog Theme

Thank you for your interest in contributing to Biz-Catalog! This document provides guidelines for contributing to this WordPress theme project.

## 🚀 How to Contribute

### Reporting Bugs
- Use the [bug report template](.github/ISSUE_TEMPLATE/bug_report.md)
- Check existing issues before creating a new one
- Provide detailed steps to reproduce the issue
- Include environment details (WordPress version, PHP version, active plugins)

### Suggesting Features
- Use the [feature request template](.github/ISSUE_TEMPLATE/feature_request.md)
- Explain how the feature would benefit users
- Consider if the feature aligns with the theme's purpose (generic business catalog theme)

### Submitting Pull Requests

1. **Fork the repository** and create a feature branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Follow coding standards**:
   - PHP: Use WordPress Coding Standards
   - CSS: Follow the existing style guide
   - JavaScript: Use modern ES6+ syntax

3. **Test your changes**:
   - Test on different WordPress versions
   - Test with ACF plugin active
   - Ensure responsive design works
   - Check for PHP errors/warnings

4. **Write clear commit messages**:
   - Use present tense ("Add feature" not "Added feature")
   - Reference issue numbers when applicable
   - Keep commits focused and atomic

5. **Create a pull request** with:
   - Clear title and description
   - Link to related issues
   - Screenshots for UI changes
   - Checklist of testing completed

## 🛠 Development Setup

1. Clone your fork:
   ```bash
   git clone https://github.com/yourusername/biz-catalog.git
   ```

2. Install dependencies (if any):
   ```bash
   npm install
   ```

3. Set up WordPress locally with:
   - WordPress 5.0+
   - PHP 7.4+
   - Advanced Custom Fields plugin

4. Activate the theme and test all functionality

## 📋 Code Standards

### PHP
- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- Use proper sanitization and escaping
- Document functions with PHPDoc comments
- Use meaningful variable and function names

### CSS
- Use BEM methodology for class naming
- Keep specificity low
- Use CSS custom properties where appropriate
- Mobile-first responsive design approach

### JavaScript
- Use modern JavaScript (ES6+)
- Include proper error handling
- Use meaningful function and variable names
- Add JSDoc comments for functions

## 🎯 Areas for Contribution

### High Priority
- Bug fixes and performance improvements
- Accessibility enhancements
- Mobile responsiveness improvements
- Documentation improvements

### Medium Priority
- Additional ACF field groups
- New template variations
- Performance optimizations
- SEO improvements

### Future Considerations
- Gutenberg block compatibility
- WooCommerce integration enhancements
- Multi-language support improvements
- Advanced customization options

## 📝 Commit Message Format

```
type(scope): brief description

Longer description if needed.

Fixes #123
```

Types:
- `feat`: New features
- `fix`: Bug fixes
- `docs`: Documentation changes
- `style`: Code style changes
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

## ✅ Pull Request Checklist

- [ ] Code follows WordPress Coding Standards
- [ ] Self-review completed
- [ ] Code is commented, particularly in complex areas
- [ ] Documentation updated if needed
- [ ] Tests added/updated if applicable
- [ ] No new PHP warnings/errors
- [ ] Responsive design verified
- [ ] Cross-browser testing completed

## 📞 Getting Help

- Create an issue for questions
- Check existing documentation
- Review WordPress theme development resources

## 📄 License

By contributing, you agree that your contributions will be licensed under the same GPL-2.0+ license as this project.

Thank you for helping make Biz-Catalog better! 🎉