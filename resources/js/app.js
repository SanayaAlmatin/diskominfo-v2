/**
 * app.js — Alpine component registrations
 */
import Alpine from 'alpinejs';
window.Alpine = Alpine;

import ApexCharts from 'apexcharts';
window.ApexCharts = ApexCharts;

// ── SweetAlert2 global setup ─────────────────────────────────────────────────
import Swal from 'sweetalert2';

/** Themed MySwal — navy confirm button, grey cancel */
const MySwal = Swal.mixin({
    confirmButtonColor: '#0F2044',
    cancelButtonColor: '#6B7280',
    reverseButtons: true,
});
window.MySwal = MySwal;

/** Toast for flash messages (top-right, auto-dismiss) */
const SwalToast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
});
window.SwalToast = SwalToast;

/**
 * confirmDelete(formEl, message)
 * Tampilkan dialog konfirmasi sebelum submit form DELETE.
 */
window.confirmDelete = function (formEl, message) {
    MySwal.fire({
        title: 'Hapus Data?',
        text: message ?? 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) formEl.submit();
    });
};

/**
 * confirmLogout(formEl)
 * Tampilkan dialog konfirmasi sebelum logout.
 */
window.confirmLogout = function (formEl) {
    MySwal.fire({
        title: 'Logout?',
        text: 'Apakah Anda yakin ingin keluar dari CMS?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) formEl.submit();
    });
};

// ── Flash messages (dibaca dari window vars yang diset Blade) ─────────────────
if (window.__flashSuccess) {
    SwalToast.fire({ icon: 'success', title: window.__flashSuccess });
}
if (window.__flashError) {
    SwalToast.fire({ icon: 'error', title: window.__flashError });
}

// ── Login errors (modal, lebih prominent dari toast) ─────────────────────────
if (window.__loginError) {
    MySwal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: window.__loginError,
        confirmButtonText: 'Coba Lagi',
    });
}
// ─────────────────────────────────────────────────────────────────────────────

import './tinymce-init.js';

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

Alpine.start();
