<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    protected $guarded = [];

    public function getChild()
    {
        return $this->hasMany(FileManager::class, 'parent_id');
    }

    public function getUserId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
