<?php

namespace App\Core\Entities;

use App\Core\Entities\Response;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'topic_category');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
