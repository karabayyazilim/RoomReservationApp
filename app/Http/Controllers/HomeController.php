<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Models\Event;

class HomeController extends Controller
{
    public function callback(Request $request, ApiService $apiService)
    {
        $apiService->generateToken($request->code);
        return redirect()->route('login');
    }

    public function welcome()
    {
        return view('welcome', [
            'events' => Event::latest()->get(),
        ]);
    }
}
