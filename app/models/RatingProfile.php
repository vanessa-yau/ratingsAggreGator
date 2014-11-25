<?php

class RatingProfile extends Eloquent {
    protected $guarded = array('id');
    protected $table = "ratings_profile";

    public function skills() {
        return $this->belongsToMany('Skill', 'profile_skill');
    }
}