<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\UserManager;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $userManager = app(UserManager::class, ['user' => Auth::user()]);
        $userManager->logout();

        redirect('/login');

        return (new Response('Logged out', 200));
    }
}
