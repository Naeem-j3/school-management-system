<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'email',
        'password',
        'name',
        'specialization_id',
        'gender',
        'joining_date',
        'address',
    ];
 /**
  * Get the user that owns the Teacher
  *
  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
  */
 public function specilization(): BelongsTo
 {
     return $this->belongsTo(Specialization::class, 'specialization_id');
 }
/**
 * Get all of the sectionTeachers for the Teacher
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function sectionTeachers(): HasMany
{
    return $this->hasMany(SectionTeacher::class);
}
}
