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
        $this->isLog();
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
        $this->isLog();
        $entry = \App\Text::find( $id);
        $entry->delete();
        return Redirect::route('edit');
    }
    
    public function editText($id){
        $this->isLog();
        $entry = \App\Text::find( $id);
        Session::flash('id', $entry->id);
        Session::flash('subject', $entry->subject);
        Session::flash('body', $entry->body);
        return  View::make('edittext');
    }
    
    public function postText($id){
        $this->isLog();
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
    
    private function generateJSON(){
        $db = \App\Text::all();
        for($j=0; $j<sizeof($db); $j++){
            $text = $db[$j] -> body;
            $text = preg_replace( "[^’]", "'" ,$text);
            $text = preg_replace( "[\.]", " . " ,$text);
            $text = preg_replace( "[\,]", " , " ,$text);
            $text = preg_replace( "[\!]", " ! " ,$text);
            $text = preg_replace( "[\?]", " ? " ,$text);
            $text = preg_replace( "[\—]", " " ,$text);
            $text = preg_replace( "[\-]", " " ,$text);
            $text = preg_replace( "[\–]", " " ,$text);
            $text = preg_replace( "[\-]", " " ,$text);
            $text = preg_replace( "[\"]", " " ,$text);
            $text = preg_replace( "!\s+!", " " ,$text);
            $text = strtolower($text); 
            $textArray =explode(" ", $text);
            for($i=0; $i<sizeof($textArray)-3; $i++){
                $outArray[$textArray[$i]][$textArray[$i+1]][$textArray[$i+2]] = isset($outArray[$textArray[$i]][$textArray[$i+1]][$textArray[$i+2]]) ? $outArray[$textArray[$i]][$textArray[$i+1]][$textArray[$i+2]]+1: 1;
            }
        }
            Storage::disk('local')->put('corpus.json', json_encode($outArray));
    }
    private function isLog(){
        if(Auth::guest()){
            return Redirect::route('signin');
        }
    }
    public function updateJSON(){
        $this->isLog();
        $this->generateJSON();
        return Redirect::route('edit');
    }
    public function generateText(){
        if(!(Input::get('number') > 3)){
            Session::flash('error', "Select a number greater than 3");
            return Redirect::route('home');
        }
        if(!(Storage::disk('local')->exists('corpus.json'))){
            $this->generateJSON();
        }
        $JSON = Storage::get('corpus.json');
        $books = json_decode($JSON, true);
        $outArray = [];
        $book = $books;
        $keys = array_keys($books);
        $index = rand(0,count($keys));
        $i = 0;
        while($index>0){
            $index -= count($keys[$i]);
            if($index>0){
                $i++;
            }
        }
        $first_word = $keys[$i];
        array_push($outArray, $first_word);
        $keys = array_keys($books[$first_word]);
        $index = rand(0,count($keys));
        $i = 0;
        while($index>0){
            $index -= count($keys[$i]);
            if($index>0){
                $i++;
            }
        }
        $second_word = $keys[$i];
        array_push($outArray, $second_word);
        
        for($n = 0; $n<=Input::get('number')-3; $n++){
            if(!array_key_exists($second_word,$books[$first_word])){
                break;
            }
            $keys = array_keys($books[$first_word][$second_word]);
            $index = rand(0,count($keys));
            $i = 0;
            while($index>0){
                $index -= count($keys[$i]);
                if($index>0){
                    $i++;
                }
            }
            $third_word = $keys[$i];
            array_push($outArray, $third_word);
            $temp = $second_word;
            $second_word = $third_word;
            $first_word = $temp;
        }
        Session::flash('text', implode(" ",$outArray));
        return Redirect::route('home');
    }
}