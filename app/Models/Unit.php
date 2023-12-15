<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

    use HasFactory;

    protected $table = 'units';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id_unit';
    protected $guarded = [
        'id'
    ];
    protected $casts = [
        'id' => 'string'
    ];

    public function user() {
        return $this->hasMany(User::class, 'unit_id', 'id_unit');
    }

    public function post() {
        return $this->hasMany(Post::class, 'unit_id', 'id_unit');
    }
}
