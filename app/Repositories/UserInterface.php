<?php namespace App\Repositories;

interface  UserInterface
{
    /**
     * @param $name
     * @param $mail
     * @param $password
     * @return mixed
     */
    public function register($name,$mail,$password);
}
