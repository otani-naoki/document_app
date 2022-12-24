<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['title','object', 'memo', 'user_id', 'created_at', 'name'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function folders()
    {
        return $this->hasMany('App\Folder');
    }
}
