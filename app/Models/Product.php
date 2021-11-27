<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'image','user_id',];

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @return BelongsToMany
     */
    public function getAllTagsId(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels');
                    //->select(['tags.id as tag_id']);
    }

    /**
     * @return BelongsToMany
     */
    public function addTeg()
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels')
                    ->using(UserTagRel::class)
                    ->withTimestamps();
    }
}
