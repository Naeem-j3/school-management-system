<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['section_name','status','grade_id','classroom_id'];
    /**
     * Get all of the comments for the Section
     *
     * @return HasMany
     */
    /**
     * Get the classroom that owns the Section
     *
     * @return BelongsTo
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    /**
     * Get all of the sectionTeachers for the Section
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sectionTeachers(): HasMany
    {
        return $this->hasMany(SectionTeacher::class);
    }

}
