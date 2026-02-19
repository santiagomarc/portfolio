/**
 * UI Utilities — Flash Message Auto-Dismiss & Global UX Enhancements
 */

document.addEventListener('DOMContentLoaded', () => {
    // ─── Flash Message Auto-Dismiss ──────────────────────────────
    const flashMessages = document.querySelectorAll('.js-flash-message');

    if (flashMessages.length > 0) {
        // Auto-dismiss after 4 seconds
        setTimeout(() => {
            flashMessages.forEach((msg) => {
                // Slide out to the right + fade
                msg.style.opacity = '0';
                msg.style.transform = 'translateX(100%)';

                // Remove from DOM after animation completes
                setTimeout(() => {
                    msg.remove();
                }, 500);
            });
        }, 4000);
    }
});
