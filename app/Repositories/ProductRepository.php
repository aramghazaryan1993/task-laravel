<?php
namespace App\Repositories;
use App\Http\Controllers\API\BaseController;
use App\Models\UserTagRel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
class ProductRepository extends BaseController implements ProductInterface
{
    public function add($name,$description,$tagId,$img)
    {

        $image = time().'_'.$img->getClientOriginalName();
        Storage::disk('public')->put($image, file_get_contents($img->getRealPath()));

        $product = Product::create(['name'=>$name,'description'=>$description,'image'=>$image,'user_id'=>Auth::user()->id]);

         $product->addTeg()->sync($tagId);
             return $product;
    }

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

        $editProduct->addTeg()->sync($tagId);

            return $editProduct;
    }

    public function deleteTeg($tagId, $productId)
    {
        return UserTagRel::where('tag_id', $tagId)->where('product_id', $productId)->delete();
    }

    public function deleteProduct($id)
    {
        return Product::where('id',$id)->delete();
    }

    public function getProduct()
    {
        $Product = Product::with('getProduct')->get()->toArray();
        return   $Product;
    }

}
