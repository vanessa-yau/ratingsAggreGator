<?php

class Team extends Eloquent {

	protected $guarded = array('id');

	public function games() {
		return $this->belongsToMany('Game', 'game_player');
	} 
}
