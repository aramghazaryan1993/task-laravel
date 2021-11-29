<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Massage as MassageResource;
use App\Http\Resources\Tag;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\Types\Integer;

class ProductController extends  BaseController
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ProductRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     *      * Add  product for function
     * Method Post
     * string min:2,max:15 name
     * string min:5,max:500 description
     * array tag_id
     * jpeg,jpg,png,gif,max:10000 image
     */
    public function add(ProductRequest $request)
    {
         $data = $this->productRepository->add($request->name,$request->description,$request->tag_id,$request->image);
                return $this->response(new ProductResource($data))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * Update product for function
     * Method Post
     * string min:2,max:15 name
     * string min:5,max:500 description
     * array tag_id
     * jpeg,jpg,png,gif,max:10000 image
     */
    public function update(ProductRequest $request,int $id)
    {
        $data = $this->productRepository->update($request->name,$request->description,$request->tag_id,$request->image,$id);
               return $this->response(new ProductResource($data))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $tagId
     * @param int $productId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * Delete product tag for function
     * Method Get
     * int $tagId
     * int $productId
     */
    public function deleteTeg(int $tagId, int $productId)
    {
           $this->productRepository->deleteTeg($tagId,$productId);
            return  $this->response(new MassageResource(['massage'=>'Delete Tag  successfully.']))->setStatusCode(Response::HTTP_GONE );
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * Delete product for function
     * Method Get
     */
    public function deleteProduct(int $id)
    {
        $this->productRepository->deleteProduct($id);
          return $this->response(new MassageResource(['massage'=>'Delete product successfully.']))->setStatusCode(Response::HTTP_GONE);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * Get product for function
     * Method Get
     */
    public function getAllProduct()
    {
        $product = $this->productRepository->getAllProduct();
           return $this->response(ProductResource::collection($product))->setStatusCode(Response::HTTP_OK );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * Get all tag from function
     * Method Get
     */
    public function getAllTag()
    {
        $tags = $this->productRepository->getAllTag();
           return $this->response(Tag::collection($tags))->setStatusCode(Response::HTTP_OK );
    }



}
