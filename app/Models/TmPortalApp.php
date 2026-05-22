<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TmPortalApp extends Model
{
    protected $table = 'tm_portal_apps';

    protected $fillable = [
        'name',
        'description',
        'category',
        'icon_type',
        'icon_material',
        'icon_bg',
        'icon_color',
        'logo_path',
        'href',
        'tags',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'tags'        => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function categoryData()
    {
        return $this->belongsTo(TmPortalAppCategory::class, 'category', 'name');
    }

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // ── Helpers ─────────────────────────────────────────────────────────────

    /**
     * Returns the public URL for the logo, or null when using a material icon.
     */
    public function getLogoUrl(): ?string
    {
        if ($this->icon_type === 'upload' && $this->logo_path) {
            return Storage::disk('public')->url($this->logo_path);
        }

        return null;
    }

    /**
     * Category label in Indonesian for display purposes.
     */
    public function getCategoryLabel(): string
    {
        return match ($this->category) {
            'admin'   => 'Administrasi',
            'health'  => 'Kesehatan',
            'finance' => 'Keuangan',
            'safety'  => 'Keamanan Publik',
            default   => $this->category,
        };
    }
}
