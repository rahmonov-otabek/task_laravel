<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image', 
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class, 'brand_id');
    }
}
