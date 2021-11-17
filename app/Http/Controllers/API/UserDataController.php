<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserData;
use App\Models\UserTagRel;
use Validator;
use App\Http\Resources\UserData as UserDataResource;
use Illuminate\Support\Facades\Auth;

class UserDataController extends BaseController
{

    function tf_convert_base64_to_image_add($base64_code, $path, $image_name = null ) {

        if ( !empty($base64_code) && !empty($path) ) :
            $image_type_pieces = '';
            // split the string to get extension and remove not required part
            // $string_pieces[0] = to get image extension
            // $string_pieces[1] = actual string to convert into image
            $string_pieces = explode( ";base64,", $base64_code);

            /*@ Get type of image ex. png, jpg, etc. */
            // $image_type[1] will return type
            if(str_contains($string_pieces[0], 'image')){
                $image_type_pieces = explode( "image/", $string_pieces[0] );
            }
            else {
                $image_type_pieces = explode( "application/", $string_pieces[0] );
            }

            $image_type = $image_type_pieces[1];
            /*@ Create full path with image name and extension */
            $store_at = $path.md5(uniqid()).'.'.$image_type;

            /*@ If image name available then use that  */
            if ( !empty($image_name) ) :
                $store_at = $path.$image_name.'.'.$image_type;

            endif;

            $decoded_string = base64_decode( $string_pieces[1] );
            file_put_contents( $store_at, $decoded_string );
            return $store_at;

        endif;
    }

    public function add(request $request)
    {
        $input = $request->all();

        // Base 64 convert to jpg
        $image  = explode('/', $this->tf_convert_base64_to_image_add($input['image'], public_path('img/')))[1];

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'tag_id' =>  'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['user_id'] = Auth::user()->id;
        $input['image']   = $image;

        $userData = UserData::create($input);
        $input['user_data_id'] = $userData->id;

        $this->addUserTegRel($input);

           return $this->sendResponse(new UserDataResource($userData), 'User Data created successfully.');
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();

        $image  = explode('/', $this->tf_convert_base64_to_image_add($input['image'], public_path('img/')))[1];

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'tag_id' =>  'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $EditUserData = UserData::where('user_id',Auth::id())->where('id',$id)->first();

        $EditUserData->name = $input['name'];
        $EditUserData->description = $input['description'];
        $EditUserData->image = $image;
        $EditUserData->save();

        $input['user_data_id'] = $id;
        $this->addUserTegRel($input);

        return $this->sendResponse(new UserDataResource($EditUserData), 'User Data updated successfully.');
    }

    public function addUserTegRel($input)
    {
        foreach ($input['tag_id'] as $key)
        {
            $Data = UserTagRel::where('tag_id',$key)->where('user_data_id',$input['user_data_id'])->first();

            if(!isset($Data->id))
            {
                $Add = new UserTagRel;
                $Add->tag_id = $key;
                $Add->user_data_id = $input['user_data_id'];
                $Add->save();
            }else{
                return $this->sendResponse([], 'Double check the same tag.');
            }
        }
    }

    public function deleteTeg($TagId,$UserDataId)
    {
        $DeleteTeg = UserTagRel::where('tag_id',$TagId)->where('user_data_id',$UserDataId)->delete();
          return $this->sendResponse([], 'Delete Data  successfully.');
    }

    public function deleteUserData($id)
    {
       $DeleteUserData = UserData::find($id)->delete();
          return $this->sendResponse([], 'Delete Data  successfully.');
    }

    public function getUserData()
    {
        $roles = UserData::with('getUserData')->get();
          return $this->sendResponse(UserDataResource::collection($roles->toArray()), 'User Data');
    }

}
