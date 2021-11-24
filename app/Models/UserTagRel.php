<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTagRel extends Pivot
{
    /**
     * @var array
     */
    protected $fillable = ['tag_id', 'user_data_id'];


    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_tag_rels';


}
