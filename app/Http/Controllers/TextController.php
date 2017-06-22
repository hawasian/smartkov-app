<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Session;
use Auth;
use Hash;
use View;
use Storage;

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
    
    public function updateJSON(){
        $JSON = "{";
        $JSON += "}";
        $db = \App\Text::all();
        for($j=0; $j<sizeof($db); $j++){
            $text = $db[$j] -> body;
            $text = preg_replace ( "[^’]", "'" ,$text);
            $text = preg_replace ( "/[^a-z0-9']/i", " " ,$text);
            $text = preg_replace ( "!\s+!", " " ,$text);
            $textArray =explode(" ", $text);
            for($i=0; $i<sizeof($textArray)-3; $i++){
                $outArray[$textArray[$i]][$textArray[$i+1]][$textArray[$i+2]] = isset($outArray[$textArray[$i]][$textArray[$i+1]][$textArray[$i+2]]) ? $outArray[$textArray[$i]][$textArray[$i+1]][$textArray[$i+2]]+1: 1;
            }
        }
            Storage::disk('local')->put('corpus.json', json_encode($outArray));

        return Redirect::route('edit');
    }
}