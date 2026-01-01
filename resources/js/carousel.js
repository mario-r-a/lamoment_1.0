/**
 * Carousel Controller
 * Attach pause-on-hover, keyboard nav, etc. without inline JS
 * Usage: import in app.js dan attach ke .carousel-container elements
 */

export function initCarousels() {
    const carousels = document.querySelectorAll('.carousel-container');
    
    carousels.forEach(container => {
        const track = container.querySelector('.carousel-track');
        if (!track) return;

        // Pause animation on hover (optional enhancement)
        container.addEventListener('mouseenter', () => {
            track.style.animationPlayState = 'paused';
        });

        container.addEventListener('mouseleave', () => {
            track.style.animationPlayState = 'running';
        });
    });
}