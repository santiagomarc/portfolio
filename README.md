# Laravel Resume Portfolio with Auth and CRUD Management 🚀

An enhanced professional portfolio website built with Laravel featuring user authentication, PostgreSQL integration, complete CRUD operations, and dynamic content management. This is Activity 3 - an advanced version with database-driven resume editing capabilities.

## ✨ Features

- **🔐  Authentication System** - Email-based login with PostgreSQL integration and custom middleware
- **📝  CRUD Operations** - Add, edit, delete skills, experiences, and education inline
- **⚡ AJAX-Powered Interface** - Seamless editing without page refreshes
- **🌐 Public/Private Access** - Dashboard for editing, public view for sharing
- **📱 Responsive Design** - Works perfectly on desktop and mobile devices
- **🌙 Dark/Light Theme Toggle** - Persistent theme switching with localStorage
- **📋 Floating Navigation** - Context-aware navigation with smooth scrolling
- **🧩 Modular Architecture** - Blade partials for maintainable code structure
- **🛡️ Security Features** - CSRF protection, input validation, password hashing
- **🎨 Interactive Elements** - Animated skill bars, project modals, inline editing forms

## 🛠️ Tech Stack

- **Backend:** PHP , Laravel Framework
- **Database:** PostgreSQL with Eloquent ORM
- **Frontend:** HTML5, CSS3, Vanilla JavaScript with AJAX
- **Templating:** Blade Engine with partial components
- **Authentication:** Custom middleware with session management
- **Security:** bcrypt hashing, CSRF tokens, input validation

## 🚀 Quick Start

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/YOUR_USERNAME/laravel-portfolio.git
   cd laravel-portfolio
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run the application**
   ```bash
   php artisan serve
   ```

5. **Visit:** `http://localhost:8000`

## 🔑 Demo Credentials

- **Email:** `xxx@gmail.com`
- **Password:** `adminpass`


## 🎯 Project Structure

```
├── app/Http/Controllers/     # Authentication & Resume controllers
├── resources/views/          # Blade templates
├── public/css/              # Stylesheets
├── public/js/               # JavaScript files
├── public/images/           # Portfolio images
└── routes/web.php           # Application routes
```

## 🌟 Key Highlights

- **Clean Architecture** - Follows Laravel MVC pattern
- **Security** - Proper authentication and session handling
- **Modern CSS** - CSS Variables for theming, Flexbox/Grid layouts
- **Vanilla JavaScript** - No dependencies, pure performance

## 👨‍💻 Author

**migoy** - Third Year BS Computer Science Student
- Email: santiagomarcstephen@gmail.com
- GitHub: [@santiagomarc](https://github.com/santiagomarc)

---

⭐ **Star this repository if you found it helpful!**
