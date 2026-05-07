/**
 * app.js — Alpine component registrations
 */
document.addEventListener('alpine:init', () => {
    window.Alpine.data('vacancyCarousel', () => ({
        active: 1,
        autoPlayInterval: null,
        totalCards: 5,

        // Swipe state
        startX: 0,
        endX: 0,

        init() {
            this.resume();
        },

        pause() {
            clearInterval(this.autoPlayInterval);
        },

        resume() {
            this.pause();
            this.autoPlayInterval = setInterval(() => {
                this.next();
            }, 5000);
        },

        next() {
            this.active = (this.active + 1) % this.totalCards;
        },

        prev() {
            this.active = (this.active - 1 + this.totalCards) % this.totalCards;
        },

        goTo(index) {
            this.active = index;
        },

        handleSwipe() {
            const delta = this.startX - this.endX;
            if (delta > 40) this.next();
            else if (-delta > 40) this.prev();
        },

        getCardClass(index) {
            const total = this.totalCards;

            if (index === this.active) {
                return [
                    'z-20 scale-100 opacity-100',
                    'w-72 md:w-96 lg:w-[400px]',
                    'shadow-[0_10px_25px_-5px_rgba(79,70,229,0.15)]',
                    'translate-y-0 -translate-x-1/2',
                    'transition-all duration-500 ease-out',
                ].join(' ');
            }

            if (index === (this.active - 1 + total) % total) {
                // Prev — left side
                return [
                    'z-10 scale-90 opacity-60 -rotate-y-6',
                    'w-72 md:w-96 lg:w-[400px]',
                    '-translate-x-[110%] md:-translate-x-[130%]',
                    'transition-all duration-500 ease-out',
                ].join(' ');
            }

            if (index === (this.active + 1) % total) {
                // Next — right side
                return [
                    'z-10 scale-90 opacity-60 rotate-y-6',
                    'w-72 md:w-96 lg:w-[400px]',
                    'translate-x-[10%] md:translate-x-[30%]',
                    'transition-all duration-500 ease-out',
                ].join(' ');
            }

            // All other cards — hidden behind the active card
            return [
                'z-0 scale-75 opacity-0 pointer-events-none',
                'w-72 md:w-96 lg:w-[400px]',
                '-translate-x-1/2',
                'transition-all duration-500 ease-out',
            ].join(' ');
        },
    }));
});
