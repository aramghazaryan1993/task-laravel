<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Support\Collection;
use App\Http\Controllers\API\BaseController;
use App\Models\Tag;

class TagRepository  implements TagInterface
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllTag()
    {
        $tags  = Tag::all();
          return  TagResource::collection($tags);
    }
}
