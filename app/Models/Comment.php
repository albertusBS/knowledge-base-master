<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function post() {

        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function reply() {

        return $this->hasMany(Reply::class);
    }
}
