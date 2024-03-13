<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReceiptStudent extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    /**
     * Get all of the comments for the ReceiptStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function studentAccounts(): HasMany
    {
        return $this->hasMany(StudentAccount::class,'receipt_id');
    }
    public function fundAccounts(): HasMany
    {
        return $this->hasMany(FundAccount::class,'receipt_id');
    }
}
