<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    
    protected $table = 'beneficiaries';

    public function members()
    {
        return $this->belongsToMany(Member::class, 'beneficiary_member')
            ->withPivot('relationship')
            ->withTimestamps();
    }

}
