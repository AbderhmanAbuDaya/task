<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orphan extends Model
{
    use HasFactory;

    protected $fillable=['user_id','death_certificate_mother','death_certificate_father','dead','birth_certificate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
