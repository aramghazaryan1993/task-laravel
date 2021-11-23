<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image','user_id',];

    protected $table = 'product';

    public function getProduct(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels');
    }

    public function addTeg()
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels')
                ->using(UserTagRel::class)
                ->withTimestamps()
                ->withPivot('status');
    }
}
