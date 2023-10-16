<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class ValidateMicroserviceToken
{
    const URL_VALIDATE_MICROSERVICE = 'http://127.0.0.1:8000/api/validateToken';
    const INVALID_TOKEN_ERROR_MESSAGE = 'Invalid Token';
    const UNAUTHORIZED_ERROR_MESSAGE = 'Unauthorized';
    const TOKEN_START_INDEX = 7;
    const SESSION_NAME = 'user';

    public function handle(Request $request, Closure $next)
    {
        try {
            $this->clearSectionUser();
            
            $token = $this->getRequestToken($request);

            $response = $this->requestValidationAuthenticationMicroservice($token);
            
            $response_json = $this->convertStringToJson($response);

            $this->validToken($response_json['valid']);

            $this->saveUserInSession($response_json['user']);

            return $next($request);

        } catch (\Exception $e) {
            Log::error([
                'function' => 'ValidateMicroserviceToken@handle',
                'error' => $e->getMessage(), 
                'data' => $request->all()
            ]);
            return response()->json(['error' => self::UNAUTHORIZED_ERROR_MESSAGE], 401);
        }
        
    }

    private function clearSectionUser(){
        session()->forget(self::SESSION_NAME);
    }

    private function getRequestToken($request){
        return $request->header('Authorization');
    }

    private function requestValidationAuthenticationMicroservice($token){
        
        $ch = curl_init(self::URL_VALIDATE_MICROSERVICE);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $token,
            'Content-Type: application/json'
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function convertStringToJson($string){
        return json_decode($string, true);
    }

    private function removeBearer($tokenString) {
        if (strpos($tokenString, 'Bearer ') === 0) {
            return substr($tokenString, self::TOKEN_START_INDEX);
        }
        return $tokenString;
    }

    private function validToken($valid){
        if(!$valid){
            throw new \Exception(self::INVALID_TOKEN_ERROR_MESSAGE);
        }
    }

    private function saveUserInSession($user){
        Session::put(self::SESSION_NAME, $user);
    }
}
