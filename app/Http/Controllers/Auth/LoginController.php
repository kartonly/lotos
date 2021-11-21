<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\UserManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember');

        $userManager = app(UserManager::class);
        $token = $userManager->auth($email, $password, $remember);

        return (new Response(['Authorization','Bearer '.$token], 200))->header('Access-Control-Allow-Origin', '*');
    }
}
