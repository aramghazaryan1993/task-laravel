<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTagRel extends Model
{
    protected $fillable = ['tag_id', 'user_data_id'];
    use HasFactory;
    protected $table = 'user_tag_rels';
}
