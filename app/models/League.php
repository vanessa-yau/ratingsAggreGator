<?php

class League extends Eloquent {

    protected $guarded = array('id');

    public function sport() {
        return $this->belongsTo('Sport');
    }

    public function teams() {
        return $this->hasMany('Team', 'last_known_league_id');
    }
    
    // need to check this relationship
    // public function players() {
    //     return $this->hasMany('Player');
    // }

}
