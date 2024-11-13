<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_category');
    }
}
