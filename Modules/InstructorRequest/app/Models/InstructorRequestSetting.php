<?php

namespace Modules\InstructorRequest\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstructorRequestSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'need_certificate',
        'need_identity_scan',
        'bank_information',
    ];

    protected $casts = [
        'need_certificate' => 'boolean',
        'need_identity_scan' => 'boolean',
        'bank_information' => 'boolean',
    ];

    /**
     * Get the translations for the instructor request setting.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(InstructorRequestSettingTranslation::class);
    }

    /**
     * Get translation for a specific language code.
     */
    public function getTranslation($langCode = null)
    {
        $langCode = $langCode ?? app()->getLocale();
        return $this->translations()->where('lang_code', $langCode)->first();
    }
}