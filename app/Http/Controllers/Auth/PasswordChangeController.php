<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Session;

class PasswordChangeController extends Controller
{
 
 public function PasswordChangeFUnction(){
    $user = Auth::user();
  
    $userPassword = AdminModel::find($user->id);

    if (!Auth::check() or session('user_palinpassword') != $userPassword->plain_password) {
        session->flush();
    }
 }
}
