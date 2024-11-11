<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
