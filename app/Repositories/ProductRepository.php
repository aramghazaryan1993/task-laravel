<?php
namespace App\Repositories;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    /**
     * Class ProductRepository
     * @package App\Repositories
     * @param string $name
     * @param string $description
     * @param int $tagId
     * @param string $img
     * @param int $productId
     * @param int $id
     * @return Product
     */

    /**
     * @param string $name
     * @param string $description
     * @param int $tagId
     * @param string $img
     * @return Product
     */
    public function add(string $name, string $description, array $tagId, $img): Product
    {
        $image = time().'_'.$img->getClientOriginalName();
        Storage::disk('public')->put($image, file_get_contents($img->getRealPath()));

        $product = Product::create(['name'=>$name,'description'=>$description,'image'=>$image,'user_id'=>Auth::user()->id]);

         $product->tag()->sync($tagId);
             return $product;
    }

    /**
     * @param string $name
     * @param string $description
     * @param int $tagId
     * @param string $img
     * @param int $id
     * @return Product
     */
    public function update(string $name, string $description,  array $tagId, $img, int $id): Product
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
     * @param int $tagId
     * @param int $productId
     * @return mixed
     */
    public function deleteTag(int $tagId, int $productId)
    {
     $deleteTag = Product::find($productId);

        return $deleteTag->tag()->detach($tagId);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteProduct(int $id)
    {
        return Product::where('id',$id)->delete();
    }


    /**
     * @return Product
     */
    public function getAllProduct()
    {
        return Product::all();
    }

    /**
     * @return Product
     */
    public function getAllTag()
    {
        return Tag::all();
    }
}
