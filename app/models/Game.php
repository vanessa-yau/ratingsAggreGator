<?php

class Game extends Eloquent {

	protected $guarded = array('id');

	public function sport() {
		return $this->belongsTo('Sport');
	}

	// change these team1,2 cols to team#_id, type: int
	public function team1() {
		return $this->belongsTo('Team');
	}

	public function team2() {
		return $this->belongsTo('Team');
	}

	public function players() {
		return $this->belongsToMany('Player');
	}

}
