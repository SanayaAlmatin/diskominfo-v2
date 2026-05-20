<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterIdentitasRequest;
use App\Http\Requests\Admin\FooterKontakRequest;
use App\Http\Requests\Admin\FooterSosmedRequest;
use App\Http\Requests\Admin\FooterUtilitasRequest;
use App\Models\TmFooterSetting;

class FooterController extends Controller
{
    private function settings(): TmFooterSetting
    {
        return TmFooterSetting::getSettings();
    }

    // ── Identitas ──────────────────────────────────────────────────────────────

    public function editIdentitas()
    {
        return view('admin.footer.identitas', ['settings' => $this->settings()]);
    }

    public function updateIdentitas(FooterIdentitasRequest $request)
    {
        $this->settings()->update($request->validated());

        return redirect()->route('admin.footer.identitas')
            ->with('success', 'Identitas footer berhasil diperbarui.');
    }

    // ── Media Sosial & Peta ────────────────────────────────────────────────────

    public function editSosmed()
    {
        return view('admin.footer.sosmed', ['settings' => $this->settings()]);
    }

    public function updateSosmed(FooterSosmedRequest $request)
    {
        $this->settings()->update($request->validated());

        return redirect()->route('admin.footer.sosmed')
            ->with('success', 'Link media sosial & peta berhasil diperbarui.');
    }

    // ── Kontak ─────────────────────────────────────────────────────────────────

    public function editKontak()
    {
        return view('admin.footer.kontak', ['settings' => $this->settings()]);
    }

    public function updateKontak(FooterKontakRequest $request)
    {
        $this->settings()->update($request->validated());

        return redirect()->route('admin.footer.kontak')
            ->with('success', 'Informasi kontak footer berhasil diperbarui.');
    }

    // ── Link Utilitas ──────────────────────────────────────────────────────────

    public function editUtilitas()
    {
        return view('admin.footer.utilitas', ['settings' => $this->settings()]);
    }

    public function updateUtilitas(FooterUtilitasRequest $request)
    {
        $this->settings()->update($request->validated());

        return redirect()->route('admin.footer.utilitas')
            ->with('success', 'Link utilitas footer berhasil diperbarui.');
    }
}
