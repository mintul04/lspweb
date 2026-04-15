// TIK Health – Main JS
// Programmer: Amanda_Defina

// Toggle mobile menu
function toggleMenu() {
    const menu = document.getElementById('mobileMenu');
    if (menu) menu.classList.toggle('open');
}

// Open modal
function openModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

// Close modal
function closeModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

// Close modal when clicking outside
function closeModalOutside(event, id) {
    if (event.target === event.currentTarget) {
        closeModal(id);
    }
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.active').forEach(function(m) {
            m.classList.remove('active');
        });
        document.body.style.overflow = '';
    }
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const nav = document.querySelector('.navbar');
    if (nav) {
        if (window.scrollY > 20) {
            nav.style.boxShadow = '0 4px 20px rgba(10,61,98,0.15)';
        } else {
            nav.style.boxShadow = '0 2px 12px rgba(10,61,98,0.08)';
        }
    }
});

// Auto-dismiss alerts
document.querySelectorAll('.alert').forEach(function(alert) {
    setTimeout(function() {
        alert.style.transition = 'opacity .5s';
        alert.style.opacity = '0';
        setTimeout(function() { alert.remove(); }, 500);
    }, 4000);
});
