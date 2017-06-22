<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Session;
use Auth;
use Hash;

class AccountController extends Controller{
    public function login(){
        $data = Input::all();
        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            Session::flash('error', 'Both Email and Password Fields are Required');
            return Redirect::route('signin');
        }else{
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            if (Auth::validate($userdata)) {
                if (Auth::attempt($userdata)) {
                    return  Redirect::route('home');
                }
            } 
            else {
                // if any error send back with message.
                Session::flash('error', 'Your Email and Passwords do not match'); 
                Session::flash('email', Input::get('email')); 
                return Redirect::route('signin');
            }
            
        }
    }
    
    public function logout(){
        Auth::logout();
        return  Redirect::route('signin');
    }
    
    public function isLogin(){
        return  !Auth::guest();
    }
    
    public function change(){
        $data = Input::all();
        $rules = array(
            'email' => 'required',
            'password' => 'required',
            'password_new' => 'required',
            'password_new' => 'regex:[((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})]',
            'password_confirm' => 'required',
            'password_confirm' => 'same:password_new', 
        );
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            Session::flash('error', 'Both Email and Password Fields are Required. Ensure your new passwords match.');
            Session::flash('email', Input::get('email')); 
            return Redirect::route('change');
        }else{
            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
            if (Auth::validate($userdata)) {
                if (Auth::attempt($userdata)) {
                    $user = \App\User::where('email', '=', Input::get('email'))->update(array('password' => Hash::make(Input::get('password_new'))));
                    Auth::logout();
                    Session::flash('error', 'Your password has been changed'); 
                    return Redirect::route('signin');
                }
            } 
            else {
                // if any error send back with message.
                Session::flash('error', 'Your Email and Passwords do not match. Ensure your new passwords match.'); 
                Session::flash('email', Input::get('email')); 
                return Redirect::route('change');
            }
            
        }
    }
}