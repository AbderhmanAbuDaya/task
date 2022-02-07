<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponsorOrphan extends Model
{
    use HasFactory;

    protected $fillable=[
        'orphan_id',
        'warranty_value',
        'warranty_period',
        'sponsor_id',
        'start_warranty_date'
    ];
}
