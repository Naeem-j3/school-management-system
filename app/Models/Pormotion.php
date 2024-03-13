<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pormotion extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function fromClassroom()
    {
        return $this->belongsTo(Classroom::class, 'from_Classroom');
    }

    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function toClassroom()
    {
        return $this->belongsTo(Classroom::class, 'to_Classroom');
    }

    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }
}
