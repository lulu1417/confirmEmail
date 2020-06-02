<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function register(Request $request)
    {
        $request->validate([
            'account' => 'required|unique:users',
            'password' => 'required|min:6',
            'email' => 'required|email'
        ]);
        try {
            DB::beginTransaction();
            $create = User::create([
                'account' => $request->account,
                'password' => $request->password,
                'email' => $request->email,
                'remember_token' => Str::random(50),
            ]);

            $URI = env('MAIL_CONFIRM_URL') . '/' . $create->id;
            $details = [
                'title' => 'Mail from Stock Analyser.com',
                'body' => "Verify your account by clicking the link",
                'URI' => $URI,
            ];
            $result['user'] = $request->email;
            Mail::to($request->email)->send(new \App\Mail\ConfirmMail($details));
            DB::commit();
            return response($create);
        }catch (Exception $exception){
            DB::rollBack();
            return response($exception);
        }

    }

    function confirm(User $user)
    {
        $user->update([
            'email_verified' => true,
            'remember_token' => Str::random(50)
        ]);
        return response($user);
    }

    function forget($account){
        $user = User::where('account', $account)->firstOrFail();
        $URI = env('MAIL_RESET_PASSWORD_URL') . '/' . $user->id;
        $details = [
            'title' => 'Mail from Stock Analyser.com',
            'body' => "Reset your password clicking the link",
            'URI' => $URI,
        ];
        $result['user'] = $user;
        Mail::to($user->email)->send(new \App\Mail\ForgetPassword($details));
        return response($result);
    }

    function resetPassword($user)
    {
        return view('resetPassword')->with('user', $user);
    }

    function updatePassword(Request $request)
    {
        $user = User::find($request->user);
        $user->update([
            'password' => $request->password,
            'remember_token' => Str::random(50)
        ]);
        return response($user);
    }
}
