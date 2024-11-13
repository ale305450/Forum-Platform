<?php

namespace  App\Core\Entities;

use App\Core\Entities\Topic;
use App\Core\Entities\User;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'user_id',
        'topic_id',
        'content',
        'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function parent()
    {
        return $this->belongsTo(Response::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Response::class, 'parent_id');
    }
}
