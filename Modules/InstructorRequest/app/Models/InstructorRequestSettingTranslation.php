<?php

namespace Modules\InstructorRequest\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstructorRequestSettingTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_request_setting_id',
        'lang_code',
        'instructions',
    ];

    /**
     * Get the instructor request setting that owns the translation.
     */
    public function instructorRequestSetting(): BelongsTo
    {
        return $this->belongsTo(InstructorRequestSetting::class);
    }
}