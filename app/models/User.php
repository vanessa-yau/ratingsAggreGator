<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Pichkrement\Messenger\Models\User implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $guarded = ['id'];

    protected $hidden = ['password'];

	protected $table = 'users';

    public function getUrlAttribute() {
        return URL::route('users.show',  Auth::user()->id);
    }

    public function ratings() {
        return $this
            ->hasMany('Rating')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    //received messages
    public function messages(){
        return $this->hasMany('Pichkrement\Messenger\Models\Message');
    }

    //messages the user has sent
    public function conversations(){
        return $this->belongsToMany('Pichkrement\Messenger\Models\Conversation');
    }
}
