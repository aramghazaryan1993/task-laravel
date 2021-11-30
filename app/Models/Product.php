<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /**
     * Class Product
     * @package App\Models
     */

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
     * @Get all tag id
     */
    public function getAllTagsId(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels');
    }

    /**
     * @return BelongsToMany
     * @detach Product
     * @detach Tag id and product id from user_tag_rels table
     */
    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels')
                     ->withTimestamps();
    }
}
