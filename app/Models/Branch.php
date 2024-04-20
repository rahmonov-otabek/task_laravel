<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Region;
use App\Models\District;
use App\Models\BranchImages;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'region_id',
        'district_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function images()
    {
        return $this->hasMany(BranchImages::class, 'branch_id');
    }
}
