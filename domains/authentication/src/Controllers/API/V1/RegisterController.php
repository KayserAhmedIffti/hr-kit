<?php

namespace SkylarkSoft\HoneyComb\Authentication\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use SkylarkSoft\HoneyComb\Authentication\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function register(RegisterFormRequest $request)
  {
    try {
      $user = new User;
      $requestedAttributes = $request->all();
      $requestedAttributes['password'] = Hash::make($request->input('password'));
      $user->fill($requestedAttributes)->save();

      $response = [
        'data' => $user,
        'status' => Response::HTTP_OK,
        'message'=>'user registration succesfull'
      ];

      return response()->json($response,Response::HTTP_OK);

    } catch(Exception $error) {

      $response = [
        'data' => [],
        'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
        'message'=> $error->getMessage()
      ];

      return response()->json($response,Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    
    
  }

}