<?php

class League extends Eloquent {

    protected $guarded = array('id');

    public function sport() {
        return $this->belongsTo('Sport');
    }

    public function teams() {
        return $this->hasMany('Team', 'last_known_league_id')->orderBy('name', 'asc');
    }
    
    public function getUrlAttribute() {
        return URL::route('leagues.show', $this->id);
    }
}
