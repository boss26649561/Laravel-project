<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    function book() {
        return $this->belongsTo('App\Book');
    }

    function user() {
        return $this->belongsTo('App\User','user_id');
    }
}
