<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;

class LikeController extends Controller
{
    public function store($documentId)
    {
        Auth::user()->like($documentId);
        return 'ok!'; //レスポンス内容
    }

    public function destroy($documentId)
    {
        Auth::user()->unlike($documentId);
        return 'ok!'; //レスポンス内容
    }
}
