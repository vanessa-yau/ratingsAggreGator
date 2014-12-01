<?php

class Team extends Eloquent {

	protected $guarded = array('id');
	public $timestamps = false; //Stop table insertions from expecting "created at" and "updated at" values

	public function games() {
		return $this->belongsToMany('Game', 'game_player');
	} 

	public function lastKnownTeam() {
		return $this->hasMany('Player');
	}
}
