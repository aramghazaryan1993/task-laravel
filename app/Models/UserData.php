<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image','user_id',];
    protected $table = 'user_data';

    public function getUserData()
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels');
    }
}
