<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product as ProductResource;
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
     * Add product api
     * Method Post
     *
     * @return \Illuminate\Http\Response
     */
    public function add(ProductRequest $request)
    {
         $data = $this->productRepository->add($request->name,$request->description,$request->tag_id,$request->image);
                return $this->response(new ProductResource($data))->setStatusCode(Response::HTTP_OK );
    }

    /**
     * Update product api
     * Method Post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,int $id)
    {
        $data = $this->productRepository->update($request->name,$request->description,$request->tag_id,$request->image,$id);
               return $this->response(new ProductResource($data))->setStatusCode(Response::HTTP_OK );
    }

    /**
     * Delete product tag api
     * Method Get
     *
     */
    public function deleteTeg(int $tagId, int $productId)
    {
        $this->productRepository->deleteTeg($tagId,$productId);
            return $this->response(['Delete Tag  successfully.'])->setStatusCode(Response::HTTP_OK );
    }

    /**
     * Delete product api
     * Method Get
     *
     */
    public function deleteProduct(int $id)
    {
        $this->productRepository->deleteProduct($id);
          return $this->response(['Delete product successfully.'])->setStatusCode(Response::HTTP_OK );
    }

    /**
     * Get product api
     * Method Get
     *
     */
    public function getAllProduct()
    {
        $product = $this->productRepository->getAllProduct();
           return $this->response(ProductResource::collection($product))->setStatusCode(Response::HTTP_OK );
    }

}
