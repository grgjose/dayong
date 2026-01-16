<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    public function beneficiaries()
    {
        return $this->belongsToMany(Beneficiary::class, 'beneficiary_member')
            ->withPivot('relationship')
            ->withTimestamps();
    }

}
