<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;  //****追加****

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function project(){
        return $this->hasMany('App\Project');
    }

        //多対多のリレーションを書く
        public function likes()
        {
            return $this->belongsToMany('App\Document','likes','user_id','document_id');
        }
    
        //この投稿に対して既にlikeしたかどうかを判別する
        public function isLike($documentId)
        {
          return $this->likes()->where('document_id',$documentId)->exists();
        }
    
        //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
        public function like($documentId)
        {
          if($this->isLike($documentId)){
            //もし既に「いいね」していたら何もしない
          } else {
            $this->likes()->attach($documentId);
          }
        }
    
        //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
        public function unlike($documentId)
        {
          if($this->isLike($documentId)){
            //もし既に「いいね」していたら消す
            $this->likes()->detach($documentId);
          } else {
          }
        }

         /**
          * パスワードリセット通知の送信
          *
          * @param  string  $token
          * @return void
          */
          public function sendPasswordResetNotification($token)
          {
              $this->notify(new ResetPassword($token));
          }
}
