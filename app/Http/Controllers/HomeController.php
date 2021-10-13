<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list|create|edit|delete', ['only' => ['index','store']]);
        $this->middleware('permission:create', ['only' => ['create','store']]);
        $this->middleware('permission:edit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if($user->getRoleNames()[0] == 'user') {
            $feedbacks = Feedback::latest()->with('status')->where('user_id', '=', $user->id)->paginate(5);
        } else {
            $feedbacks = Feedback::latest()->with('status')->with('user')->paginate(5);
        }
        return view('home',compact('feedbacks'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
