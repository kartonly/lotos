<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\UserManager;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request){
        $remember=false;
        $email = $request->input('email');
        $password = $request->input('password');

        $userManager = app(UserManager::class);
        $userManager->create($request->all());

        $token = $userManager->auth($email, $password, $remember);

        return (new Response(['Authorization','Bearer '.$token], 200))->header('Access-Control-Allow-Origin', '*');
    }
}
