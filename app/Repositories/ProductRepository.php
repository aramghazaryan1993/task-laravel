<?php
namespace App\Repositories;
use App\Http\Controllers\API\BaseController;
use App\Models\Tag;
use App\Models\UserTagRel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
class ProductRepository  implements ProductInterface
{
    /**
     * @param $name
     * @param $description
     * @param $tagId
     * @param $img
     * @return mixed
     */
    public function add($name,$description,$tagId,$img)
    {
        $image = time().'_'.$img->getClientOriginalName();
        Storage::disk('public')->put($image, file_get_contents($img->getRealPath()));

        $product = Product::create(['name'=>$name,'description'=>$description,'image'=>$image,'user_id'=>Auth::user()->id]);

         $product->tag()->sync($tagId);
             return $product;
    }

    /**
     * @param $name
     * @param $description
     * @param $tagId
     * @param $img
     * @param $id
     * @return mixed
     */
    public function update($name,$description,$tagId,$img, $id)
    {
        $editProduct = Product::where('user_id', Auth::id())->where('id', $id)->first();

        $image = time().'_'.$img->getClientOriginalName();
        Storage::disk('public')->put($image, file_get_contents($img->getRealPath()));

        if(Storage::exists('public/'.$image)){
            Storage::delete('public/'.$image);
        }

        $editProduct->name = $name;
        $editProduct->description = $description;
        $editProduct->image = $image;
        $editProduct->save();

        $editProduct->tag()->sync($tagId);

            return $editProduct;
    }

    /**
     * @param $tagId
     * @param $productId
     * @return mixed
     */
    public function deleteTeg($tagId, $productId)
    {
     $deleteTag = Product::find($productId);

        return $deleteTag->tag()->detach($tagId);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id)
    {
        return Product::where('id',$id)->delete();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllProduct()
    {
        return Product::all();
    }

    /**
     * @return Tag[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAllTag()
    {
        return Tag::all();
    }

}
