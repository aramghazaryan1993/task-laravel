<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Massage as MassageResource;

class AuthController extends BaseController
{
    /**
     * Class AuthController
     * @package App\Http\Controllers\API
     */

    /**
     * @var UserRepository
     */
    private UserRepository $authRepository;

    /**
     * AuthController constructor.
     * @param UserRepository $authRepository
     */
    public function __construct(UserRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Function for creationg user
     */
    public function register(UserRequest $request)
    {
       $user = $this->authRepository->register($request->name,$request->email,$request->password);
         return $this->response(new UserResource($user))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Function for login user
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' =>$request->email, 'password' =>$request->password ])){

            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name']  =  $user->name;
            $success['email'] =  $user->email;

            return $this->response(new UserResource($success))
                        ->setStatusCode(Response::HTTP_OK);
        }
        else{
            return $this->response(MassageResource('Unauthorised'))
                        ->setStatusCode(Response::HTTP_BAD_REQUEST );
        }
    }

}
