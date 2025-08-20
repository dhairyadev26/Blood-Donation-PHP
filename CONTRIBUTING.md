# Contributing to B24U Blood Donation System

Thank you for your interest in contributing to the B24U Blood Donation Management System! We welcome contributions from the community.

## How to Contribute

### 🐛 Reporting Bugs

1. **Check existing issues** first to avoid duplicates
2. **Use the bug report template** when creating new issues
3. **Provide detailed information** including:
   - Steps to reproduce the bug
   - Expected vs actual behavior
   - Screenshots (if applicable)
   - System information (OS, PHP version, browser)

### 💡 Suggesting Features

1. **Check existing feature requests** to avoid duplicates
2. **Clearly describe the feature** and its benefits
3. **Provide use cases** and examples
4. **Consider the scope** - keep it relevant to blood donation management

### 🔧 Code Contributions

#### Setup Development Environment

1. Fork the repository
2. Clone your fork locally
3. Set up XAMPP/WAMP server
4. Import the database (`Database/b24u.sql`)
5. Configure email settings

#### Coding Standards

- **PHP**: Follow PSR-12 coding standards
- **HTML**: Use semantic HTML5 elements
- **CSS**: Use consistent naming conventions
- **JavaScript**: Use ES6+ features where appropriate
- **Comments**: Write clear, concise comments

#### Pull Request Process

1. **Create a feature branch** from `main`
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes** following our coding standards

3. **Test your changes** thoroughly:
   - Test all affected functionality
   - Verify database operations
   - Check email functionality
   - Test on different browsers

4. **Commit your changes** with descriptive messages:
   ```bash
   git commit -m "Add: New donor search functionality"
   ```

5. **Push to your fork** and create a pull request

6. **Fill out the PR template** completely

#### Code Review Process

- All PRs require at least one review
- Address feedback promptly
- Keep PRs focused and reasonably sized
- Update documentation if needed

## 🏷️ Issue Labels

We use the following labels to categorize issues:

- `bug` - Something isn't working
- `enhancement` - New feature or improvement
- `documentation` - Documentation updates
- `help wanted` - Extra attention needed
- `good first issue` - Good for newcomers
- `priority: high` - Critical issues
- `priority: medium` - Important but not critical
- `priority: low` - Nice to have

## 📝 Commit Message Guidelines

Use clear and descriptive commit messages:

- `Add:` - New features
- `Fix:` - Bug fixes
- `Update:` - Updates to existing features
- `Refactor:` - Code refactoring
- `Docs:` - Documentation changes
- `Style:` - CSS/styling changes
- `Test:` - Testing related changes

Examples:
```
Add: Blood type filter in donor search
Fix: Email notification not sending OTP
Update: Donor registration form validation
Docs: Update installation instructions
```

## 🎯 Areas for Contribution

We especially welcome contributions in these areas:

### High Priority
- **Security improvements** (input validation, SQL injection prevention)
- **Mobile responsiveness** enhancements
- **Performance optimization**
- **Accessibility improvements**

### Medium Priority
- **UI/UX improvements**
- **Additional blood type support**
- **Notification system enhancements**
- **Report generation features**

### Documentation
- **API documentation**
- **User guides**
- **Installation tutorials**
- **Video tutorials**

## 🧪 Testing Guidelines

Before submitting a PR, ensure:

1. **Functionality Testing**
   - All forms work correctly
   - Database operations are successful
   - Email notifications are sent
   - Authentication works properly

2. **Browser Testing**
   - Chrome (latest)
   - Firefox (latest)
   - Safari (latest)
   - Edge (latest)

3. **Mobile Testing**
   - Responsive design works
   - Touch interactions function
   - Performance is acceptable

## 📚 Resources

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [HTML5 Specification](https://html.spec.whatwg.org/)
- [CSS3 Documentation](https://developer.mozilla.org/en-US/docs/Web/CSS)

## 💬 Getting Help

If you need help or have questions:

1. **Check the documentation** first
2. **Search existing issues** for similar problems
3. **Create a new issue** with the `help wanted` label
4. **Be specific** about what you're trying to achieve

## 🎉 Recognition

Contributors will be recognized in:
- README.md contributors section
- Release notes for significant contributions
- Special mentions for outstanding contributions

Thank you for helping make blood donation more accessible and efficient! 🩸

---

**Happy Contributing!** 🚀
