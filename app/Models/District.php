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

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
