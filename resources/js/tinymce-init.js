/**
 * tinymce-init.js
 * Fully bundled TinyMCE via Vite — no CDN, no API key required.
 *
 * Dua konfigurasi:
 *  • textarea.tinymce-editor        → editor lengkap  (Sekilas Diskominfo)
 *  • textarea.tinymce-editor-simple → editor ringkas  (Visi Misi, Deskripsi, Program)
 */

import tinymce from 'tinymce';

// Core requirements
import 'tinymce/themes/silver';
import 'tinymce/icons/default';
import 'tinymce/models/dom';

// Skin UI (Vite injects this as a global <style> — required for the editor chrome)
import 'tinymce/skins/ui/oxide/skin.css';

// Plugins — full editor
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/table';
import 'tinymce/plugins/code';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/charmap';

// --------------------------------------------------------------------------
// Shared base configuration
// --------------------------------------------------------------------------

/**
 * LICENSE KEY
 * - Untuk mendapatkan API key resmi (gratis): https://www.tiny.cloud/auth/signup/
 *   Setelah daftar, tambahkan ke .env:  VITE_TINYMCE_API_KEY=your-key-here
 * - Jika tidak menggunakan .env key, nilai 'gpl' digunakan sebagai fallback
 *   (sesuai untuk proyek pemerintah / non-komersial).
 */
const licenseKey = import.meta.env.VITE_TINYMCE_API_KEY || 'gpl';

const sharedConfig = {
    license_key: licenseKey,
    skin: false,        // skin CSS loaded via Vite import above
    content_css: false, // prevent dynamic fetch; use content_style below
    content_style: `
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, sans-serif;
            font-size: 14px;
            color: #111827;
            line-height: 1.75;
            margin: 8px 12px;
        }
        h2 { font-size: 1.2em; font-weight: 700; margin: 0.85em 0 0.4em; }
        h3 { font-size: 1.05em; font-weight: 600; margin: 0.75em 0 0.35em; }
        h4 { font-size: 1em; font-weight: 600; margin: 0.65em 0 0.3em; }
        a  { color: #0F2044; text-decoration: underline; }
        ul, ol { padding-left: 1.5em; }
        li { margin-bottom: 0.25em; }
        p  { margin: 0 0 0.75em; }
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid #d1d5db; padding: 6px 10px; }
        th { background: #f3f4f6; font-weight: 600; }
    `,
    promotion: false,
    branding: false,
    menubar: false,
    resize: false,
    width: '100%',
    relative_urls: false,
    remove_script_host: false,
};

// --------------------------------------------------------------------------
// Full editor — Sekilas Diskominfo
// --------------------------------------------------------------------------
tinymce.init({
    ...sharedConfig,
    selector: 'textarea.tinymce-editor',
    plugins: 'lists link autolink table code searchreplace wordcount charmap',
    toolbar: [
        'undo redo | blocks | bold italic underline strikethrough',
        'bullist numlist | link table charmap | searchreplace | code',
    ].join(' | '),
    block_formats: 'Paragraf=p; Judul 2=h2; Judul 3=h3; Judul 4=h4',
    height: 420,
    statusbar: true,
    elementpath: false,
    wordcount_countcharacters: false,
    // Pastikan value dikirim ke textarea saat form di-submit
    setup(editor) {
        editor.on('change', () => editor.save());
    },
});

// --------------------------------------------------------------------------
// Simple editor — Visi Misi, Deskripsi SOTK, Deskripsi Program & Lowongan
// --------------------------------------------------------------------------
tinymce.init({
    ...sharedConfig,
    selector: 'textarea.tinymce-editor-simple',
    plugins: 'lists link autolink',
    toolbar: 'bold italic underline | bullist numlist | link | removeformat',
    height: 220,
    setup(editor) {
        editor.on('change', () => editor.save());
    },
});
