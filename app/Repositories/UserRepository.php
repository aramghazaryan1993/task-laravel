<?php
namespace App\Repositories;
use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class UserRepository extends BaseController implements UserInterface
{
    /**
     * @param $name
     * @param $email
     * @param $password
     * @return mixed
     */
    // Creat Antty user
    public function register($name,$email,$password)
    {
        $user             = User::create(['name'=>$name,'email'=>$email,'password'=>bcrypt($password)]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name']  =  $user->name;
        $success['email'] =  $user->email;

              return $success;
    }

}
