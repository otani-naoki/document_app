<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    protected $fillable = ['id', 'title', 'user_id', 'project_id'];

    public function project(){
        return $this->belongsTo('App\Project','project_id','id');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
