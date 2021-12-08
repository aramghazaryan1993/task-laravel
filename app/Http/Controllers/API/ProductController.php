<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Massage as MassageResource;
use App\Http\Resources\Tag as TagResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 * @param ProductRequest $request
 * @param int $id
 * @param int $tagId
 * @param int $productId
 */
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
     * @return ProductResource
     */
    public function add(ProductRequest $request)
    {
        $product = $this->productRepository->add($request->name, $request->description, $request->tag_id, $request->image);
                return $this->response(new ProductResource($product))->setStatusCode(Response::HTTP_CREATED);
    }


    /**
     * @param ProductRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Function for update product and add tags
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
     * DELETE:Function for delete tag
     */
    public function deleteTag(int $tagId, int $productId)
    {
           $this->productRepository->deleteTag($tagId,$productId);
            return  $this->response(new MassageResource('Delete Tag  successfully.'))->setStatusCode(Response::HTTP_GONE );
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * DELETE:Function for delete product
     */
    public function deleteProduct(int $id)
    {
        $this->productRepository->deleteProduct($id);
          return $this->response(new MassageResource('Delete product successfully.'))->setStatusCode(Response::HTTP_GONE);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Function for get all product
     */
    public function getAllProduct()
    {
        $product = $this->productRepository->getAllProduct();
           return $this->response(ProductResource::collection($product))->setStatusCode(Response::HTTP_OK );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * GET:Function for get all tag
     */
    public function getAllTag()
    {
        $tags = $this->productRepository->getAllTag();
           return $this->response(TagResource::collection($tags))->setStatusCode(Response::HTTP_OK );
    }
}
