// Modal popup for projects
const projectLinks = document.querySelectorAll('.project-link');
const modal = document.getElementById('project-modal');
const modalBody = document.getElementById('modal-body');
const closeBtn = document.querySelector('.close');

// Hardcoded project details with images (fallback for specific projects)
const projectDetails = {
    1: {
        title: 'Laravel Portfolio with Authentication',
        images: ['/images/p1.png'],
        description: 'A professional portfolio website built with Laravel framework featuring user authentication, responsive design, and dynamic content management.',
        technologies: 'Laravel, PHP, PostgreSQL, Blade, CSS3'
    },
    2: {
        title: 'Enhanced K-Means Clustering Algorithm',
        images: ['/images/p2.png', '/images/p21.png'],
        description: 'Research project implementing a distance-based soft weighting mechanism for noise-handling in K-Means algorithm using Gaussian RBF weighted influence.',
        technologies: 'Python, NumPy, Scikit-learn, Matplotlib'
    },
    3: {
        title: 'Nutrition-Based Food Ordering System',
        images: ['/images/p3.png', '/images/p31.png'],
        description: 'Console application with GUI built using Java and MySQL, featuring nutritional information tracking and user-friendly ordering interface.',
        technologies: 'Java, MySQL, Swing, JDBC'
    }
};

// Project modal functionality
projectLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-project');
        const project = projectDetails[id];
        
        if (project) {
            let modalContent = `<h3>${project.title}</h3>`;
            if (project.images && project.images.length > 0) {
                project.images.forEach(img => {
                    modalContent += `<img src="${img}" alt="${project.title}" class="modal-image">`;
                });
            }            
            modalContent += `<p>${project.description}</p>`;
            modalContent += `<p><strong>Technologies:</strong> ${project.technologies}</p>`;
            
            modalBody.innerHTML = modalContent;
        } else {
            modalBody.innerHTML = '<p>Project details coming soon...</p>';
        }
        
        modal.style.display = 'block';
    });
});

if (closeBtn) {
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    };
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

// Floating Navigation Show/Hide
const floatingNav = document.getElementById('floatingNav');
const navLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
        floatingNav.classList.add('visible');
    } else {
        floatingNav.classList.remove('visible');
    }
    updateActiveNavLink();
    animateSkillBars();
});

// Smooth scrolling for navigation links
document.querySelectorAll('.nav-link[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Update active navigation link based on scroll position
function updateActiveNavLink() {
    const sections = document.querySelectorAll('section');
    const scrollPos = window.scrollY + 100;
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionBottom = sectionTop + section.offsetHeight;
        const sectionId = section.getAttribute('id');
        const navLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
        
        if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
            navLinks.forEach(link => link.classList.remove('active'));
            if (navLink) navLink.classList.add('active');
        }
    });
}

// Theme Toggle functionality
function initThemeToggle() {
    const themeToggle = document.getElementById('themeToggle');
    const currentTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    
    function updateThemeIcon(theme) {
        themeToggle.textContent = theme === 'dark' ? '☀️' : '🌙';
        themeToggle.title = theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode';
    }
    
    updateThemeIcon(currentTheme);

    themeToggle.addEventListener('click', function() {
        const theme = document.documentElement.getAttribute('data-theme');
        const newTheme = theme === 'dark' ? 'light' : 'dark';
        
        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
    });
}

function animateSkillBars() {
    const skillBars = document.querySelectorAll('.skill-progress');
    
    skillBars.forEach(bar => {
        const rect = bar.getBoundingClientRect();
        const isVisible = rect.top >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight);
        
        if (isVisible && !bar.classList.contains('animated')) {
            const level = bar.getAttribute('data-level');
            bar.style.width = level + '%';
            bar.classList.add('animated');
        }
    });
}

const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const skillBars = entry.target.querySelectorAll('.skill-progress');
            skillBars.forEach(bar => {
                const level = bar.getAttribute('data-level');
                bar.style.width = level + '%';
            });
        }
    });
}, observerOptions);

function initContactForm() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const responseDiv = document.getElementById('form-response');
            
            // CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    responseDiv.innerHTML = '<p style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-top: 15px;"><i class="fas fa-check-circle"></i> ' + data.message + '</p>';
                    form.reset();
                } else {
                    responseDiv.innerHTML = '<p style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px; margin-top: 15px;"><i class="fas fa-exclamation-circle"></i> Error sending message. Please try again.</p>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseDiv.innerHTML = '<p style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px; margin-top: 15px;"><i class="fas fa-exclamation-triangle"></i> Network error. Please try again.</p>';
            });
        });
    }
}

// init everything
document.addEventListener('DOMContentLoaded', function() {
    initThemeToggle();
    initContactForm();
    const skillsSection = document.getElementById('skills');
    if (skillsSection) {
        observer.observe(skillsSection);
    }
    animateSkillBars();
});