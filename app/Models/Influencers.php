<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Influencer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'instagram_user', 'followers_count', 'category'];

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}