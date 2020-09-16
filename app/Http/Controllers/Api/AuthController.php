<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AuthController extends ApiController
{
    /**
     * Get a JWT via given credentials
     *
     * @SWG\Post(
     *     path="/api/login",
     *     description="Log in user",
     *     operationId="api.login",
     *     consumes={"multipart/form-data"},
     *     produces={"application/json"},
     *     tags={"AuthController"},
     *     @SWG\Parameter(
     *         name="email",
     *         description="email",
     *         required=true,
     *         in="formData",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         description="password",
     *         required=true,
     *         in="formData",
     *         type="string",
     *         minLength=6,
     *         maxLength=10
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User has been logged in successfully"
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="The given data was invalid"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ];
        if (\Auth::once($credentials)) {
            return ['access_token' => \Auth::user()->createToken('auth_token')->plainTextToken];
        }
        abort(422, 'Invalid Credentials');
    }
}
