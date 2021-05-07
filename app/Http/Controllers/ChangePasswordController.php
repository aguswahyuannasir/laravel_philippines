<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
  
class ChangePasswordController extends Controller
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
        return view('auth.changePassword');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ], [
            'current_password.required' => 'Password Lama harus diisi',
            'new_password.required' => 'Password Baru harus diisi',
            'new_confirm_password.required' => 'Konfirmasi Password Baru harus diisi',
            'new_confirm_password.same' => 'Konfirmasi harus sama dengan Password Baru'
        ]);
   
        User::find(auth()->user()->IdUser)->update(['password'=> Hash::make($request->new_password)]);
   
        return view('auth.changePassword');
    }
}