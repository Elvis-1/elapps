<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    // table name
    protected $table = 'posts';
    //timestamp
    public $timestamp = true;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}


