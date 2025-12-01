<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'module_id',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
