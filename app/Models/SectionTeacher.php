<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionTeacher extends Model
{
    use HasFactory;
    protected $fillable=['teacher_id','section_id'];
    /**
     * Get the teachers that owns the SectionTeacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teachers(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    /**
     * Get the sections that owns the SectionTeacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sections(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
