/*
// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {
    // 1. Fade-In Animation for Cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0'; // Start with invisible cards
        card.style.transition = 'opacity 0.6s ease-in-out';
        setTimeout(() => {
            card.style.opacity = '1'; // Fade in after a slight delay
        }, index * 200); // Stagger the animation for each card
    });

    // 2. Hover Effects on Stats Cards
    cards.forEach(card => {
        card.addEventListener('mouseover', function () {
            this.style.transform = 'scale(1.02)';
            this.style.boxShadow = '0 6px 16px rgba(0, 0, 0, 0.15)';
            this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        });
        card.addEventListener('mouseout', function () {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        });
    });

    // 3. Button Click Animation (Pulse Effect)
    const buttons = document.querySelectorAll('.btn-primary');
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            this.style.animation = 'pulse 0.3s ease';
        });
    });

    // 4. Highlight Active Sidebar Link Dynamically
    const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
    const currentPath = window.location.pathname.split('/').pop(); // Get the current page filename (e.g., 'dashboard.php')

    sidebarLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPath) {
            link.style.backgroundColor = '#fff';
            link.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.05)';
            link.classList.add('active');
        }
    });
});

// Define the pulse animation for buttons
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(styleSheet);*/
