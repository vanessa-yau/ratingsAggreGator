<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Rating extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $guarded = array('id');

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ratings';

    public function player() {
        return $this->belongsTo('Player');
    }

    public function game() {
        return $this->belongsTo('Game');
    }

    public function skill() {
        return $this->belongsTo('Skill');
    }

}
