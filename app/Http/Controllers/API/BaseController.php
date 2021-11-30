<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Class BaseController
     * @package App\Http\Controllers\API
     */

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * Function for send response from controller functions
     */
    public function response()
    {
        return response(...func_get_args());
    }
}
