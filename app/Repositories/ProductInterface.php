<?php namespace App\Repositories;

interface ProductInterface
{
    public function add($name,$description,$tagId,$img);

    public function update($name,$description,$tagId,$img, $id);

    public function deleteTeg($tagId,$productId);

    public function deleteProduct($id);

    public function getProduct();

    public function addUserTegRel($productId,$tagId);
}
