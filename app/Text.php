<?php

namespace App;
use Eloquent;

class Text extends Eloquent
{
   protected $fillable = [
        'subject', 'body',
    ]; 
}