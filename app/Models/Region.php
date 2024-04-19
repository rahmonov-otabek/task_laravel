<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
    ];

    public function districts()
    {
        return $this->hasMany(District::class, 'region_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class, 'region_id');
    }
}
