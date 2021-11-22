<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\API\BaseController;

class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */

    private UserRepository $authRepository;

    public function __construct(UserRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRequest $request)
    {
       $user = $this->authRepository->register($request->name,$request->email,$request->password);
      //  return $this->sendResponse($this->authRepository->register($request->name,$request->email,$request->password), 'User register successfully.',200);
        return $this->response([$user])->setStatusCode(Response::HTTP_OK );
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' =>$request->email, 'password' =>$request->password ])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;

            return $this->response($success)
                   ->setStatusCode(Response::HTTP_OK);
        }
        else{
            return $this->response(['error'=>'Unauthorised'])
                   ->setStatusCode(Response::HTTP_BAD_REQUEST );
           // return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }


}
