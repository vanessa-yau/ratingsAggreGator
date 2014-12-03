<?php

class Team extends Eloquent {

	protected $guarded = array('id');
	public $timestamps = false; //Stop table insertions from expecting "created at" and "updated at" values

	public function games() {
		return $this->belongsToMany('Game', 'game_player');
	} 

	public function lastKnownPlayers() {
		return $this->hasMany('Player', 'last_known_team');
	}

    public function leagues() {
        return $this->belongsTo('League');
    }

    public function getUrlAttribute() {
        return URL::route('teams.show', $this->id);
    }
}
