<?php

namespace App\Models;

use App\Notifications\SendNotificationByCoproduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use App\Events\CreatedEventByCoproduct;
use App\Events\UpdatedEventByCoproduct;

/**
 * Class Product
 * @package App\Models
 */
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


    protected $dispatchesEvents = [
        "created" => CreatedEventByCoproduct::class,
        "updated" => UpdatedEventByCoproduct::class,
    ];


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
