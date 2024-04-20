<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;

class District extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'region_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at' 
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class, 'district_id');
    }
}
