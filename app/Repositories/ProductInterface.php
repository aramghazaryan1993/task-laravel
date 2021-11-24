<?php namespace App\Repositories;

interface ProductInterface
{
    /**
     * @param $name
     * @param $description
     * @param $tagId
     * @param $img
     * @return mixed
     */
    public function add($name,$description,$tagId,$img);

    /**
     * @param $name
     * @param $description
     * @param $tagId
     * @param $img
     * @param $id
     * @return mixed
     */
    public function update($name,$description,$tagId,$img, $id);

    /**
     * @param $tagId
     * @param $productId
     * @return mixed
     */
    public function deleteTeg($tagId,$productId);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id);

    /**
     * @return mixed
     */
    public function getAllProduct();

}
