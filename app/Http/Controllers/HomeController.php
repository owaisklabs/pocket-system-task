<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::all();
        return view('home', compact('user'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password;
        if ($request->file('image')) {
            $image = $request->image;
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            Storage::disk('public_user_img')->put($imageName, \File::get($image));
            $user->image = $imageName;
        }
        $user->save();
        return redirect()->back();
    }
    public function show(Request $request)
    {
        return [
            'status' => 'success',
            'data' => User::find($request->id)
        ];
    }
    public function update(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->name = $request->name;
            $user->password = $request->password;
            $user->phone = $request->phone;
            $user->save();
            return redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        User::find($request->id)->delete();
        return [
            'status' => 'success'
        ];
    }
}
