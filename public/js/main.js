// Menú móvil
const menuToggle = document.getElementById('menuToggle');
const navLinks = document.querySelector('.nav-links');

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        const icon = menuToggle.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });
}

// Cerrar menú al hacer clic en un enlace
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('active');
        const icon = menuToggle.querySelector('i');
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-times');
    });
});

// Navbar con efecto al hacer scroll
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.style.background = 'rgba(13, 13, 13, 0.98)';
        navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.3)';
    } else {
        navbar.style.background = 'rgba(13, 13, 13, 0.95)';
        navbar.style.boxShadow = 'none';
    }
});

// Animación de elementos al hacer scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.servicio-card, .feature').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'all 0.6s ease';
    observer.observe(el);
});

// ============ FILTRO Y BÚSQUEDA DE SERVICIOS ============
const searchInput = document.getElementById('searchServicios');
const filterBtns = document.querySelectorAll('.filter-btn');
const serviciosCards = document.querySelectorAll('.servicio-card-moderno');

// Búsqueda en tiempo real
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        serviciosCards.forEach(card => {
            const nombre = card.dataset.nombre || '';
            card.style.display = nombre.includes(query) ? 'flex' : 'none';
        });
    });
}

// Filtros por categoría
filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const filter = btn.dataset.filter;
        
        serviciosCards.forEach(card => {
            if (filter === 'todos' || card.dataset.categoria === filter) {
                card.style.display = 'flex';
                card.style.animation = 'fadeIn 0.5s ease';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Animación fadeIn
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);

// Validación del formulario de servicio
const formServicio = document.getElementById('formServicio');
if (formServicio) {
    formServicio.addEventListener('submit', (e) => {
        const precio = document.getElementById('precio').value;
        const duracion = document.getElementById('duracion').value;
        
        if (precio <= 0) {
            e.preventDefault();
            alert('El precio debe ser mayor a 0');
            return false;
        }
        
        if (duracion < 5) {
            e.preventDefault();
            alert('La duración mínima es de 5 minutos');
            return false;
        }
    });
}

// ============ VALIDACIÓN FORMULARIO CITAS ============
const formCita = document.getElementById('formCita');
if (formCita) {
    const fechaInput = document.getElementById('fecha');
    const hoy = new Date().toISOString().split('T')[0];
    
    if (fechaInput) {
        fechaInput.setAttribute('min', hoy);
        
        fechaInput.addEventListener('change', (e) => {
            if (e.target.value < hoy) {
                alert('No puedes agendar citas en el pasado');
                e.target.value = hoy;
            }
        });
    }
    
    formCita.addEventListener('submit', (e) => {
        const servicio = document.getElementById('servicio_id').value;
        const barbero = document.getElementById('barbero_id').value;
        const fecha = document.getElementById('fecha').value;
        const hora = document.getElementById('hora').value;
        
        if (!servicio || !barbero || !fecha || !hora) {
            e.preventDefault();
            alert('Por favor completa todos los campos obligatorios');
            return false;
        }
    });
}