<?php namespace App\Repositories;

interface  UserInterface
{
    public function register($name,$mail,$password);
}
