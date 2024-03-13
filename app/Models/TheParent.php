<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TheParent extends Model
{
    use HasFactory,HasApiTokens;
    protected $guarded=[];
     // Relationship with Blood model
     public function fatherBlood()
     {
         return $this->belongsTo(Blood::class, 'father_blood_id');
     }

     // Relationship with Religion model
     public function fatherReligion()
     {
         return $this->belongsTo(Religion::class, 'father_religion_id');
     }

     // Relationship with Nationality model
     public function motherNationality()
     {
         return $this->belongsTo(Nationalitie::class, 'mother_nationality_id');
     }

     // Relationship with Blood model
     public function motherBlood()
     {
         return $this->belongsTo(Blood::class, 'mother_blood_id');
     }

     // Relationship with Religion model
     public function motherReligion()
     {
         return $this->belongsTo(Religion::class, 'mother_religion_id');
     }
}
