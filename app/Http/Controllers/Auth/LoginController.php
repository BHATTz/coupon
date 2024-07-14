<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    protected function authenticated(Request $request, $user) {
	 if (Auth::user()->role == "admin") {
	 	return redirect('admin.admin');
	 } else if (Auth::user()->role == "user") {
	 	return redirect('dashboard');
	 } else {
	 	return redirect('welcome');
	 }
}
}
