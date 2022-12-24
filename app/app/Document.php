<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
        'id', 
        'title', 
        'date', 
        'user_id', 
        'folder_id', 
        'file',
    ];

    public function folder(){
        return $this->belongsTo('App\folder','folder_id','id');
    }
}
