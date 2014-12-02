<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $guarded = array('id');

    protected $hidden = array('password');

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
}
