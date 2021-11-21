<?php


namespace App\Http\Controllers\API\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\UserResource;
use App\Models\Booking;
use App\Models\Organisation;
use App\UserManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $user = User::all()
            ->find(Auth::user());

        return new UserResource($user);
    }

    public function myBookings(Request $request)
    {
        $now = Carbon::now()->toDateString();
        $id=Auth::user()->id;

        $bookings = Booking::where('user_id', $id)->where('end','>=',$now)->with('services')->get();

        return (new Response(new BookingResource($bookings), 200))->header('Access-Control-Allow-Origin', '*');
    }

    public function myBookingsDelete($booking)
    {
        $booking = Booking::where('id', $booking)->first();
        $booking->available = 0;

        $now = Carbon::now()->toDateString();
        $id=Auth::user()->id;
        $bookings = Booking::where('user_id', $id)->where('end','>=',$now)->with('services')->get();
        return $bookings;
    }

    public function update(Request $request, User $user)
    {
        $userManager = app(UserManager::class, ['user' => Auth::user()]);
        $user = $userManager->update($request->all());

        return new UserResource($user);
    }
}
