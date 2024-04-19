<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

class BranchImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'branch_id',
        'use_in_slider',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
