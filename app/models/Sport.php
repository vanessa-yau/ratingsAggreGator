<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Sport extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'sports';

    protected $guarded = array('id');

    public function players() {
    	return $this->hasMany('Player');
    }

    public function games() {
        return $this->hasMany('Game');
    }
}
