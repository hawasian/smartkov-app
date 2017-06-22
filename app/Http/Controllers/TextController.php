<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Session;
use Auth;
use Hash;
use View;

class TextController extends Controller{
    public function addText(){
        $data = Input::all();
        $rules = array(
            'subject' => 'required',
            'body' => 'required',
        );
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            Session::flash('error', 'Both Subject and the Text body are required');
            return Redirect::route('new');
        }else{
            $entry = new \App\Text;
            $entry->subject=Input::get('subject');
            $entry->body=Input::get('body');
            $entry->save();
            return Redirect::route('edit');
        }
    }
    
    public function deleteText($id){
        $entry = \App\Text::find( $id);
        $entry->delete();
        return Redirect::route('edit');
    }
    
    public function editText($id){
        $entry = \App\Text::find( $id);
        Session::flash('id', $entry->id);
        Session::flash('subject', $entry->subject);
        Session::flash('body', $entry->body);
        return  View::make('edittext');
    }
    
    public function postText($id){
        $data = Input::all();
        $rules = array(
            'subject' => 'required',
            'body' => 'required',
        );
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            Session::flash('error', 'Both Subject and the Text body are required');
            return Redirect::route('new');
        }else{
            $entry = \App\Text::find($id);
            $entry->subject=Input::get('subject');
            $entry->body=Input::get('body');
            $entry->save();
            return Redirect::route('edit');
        }
    }
}