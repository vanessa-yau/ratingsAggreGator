<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Player extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $guarded = array('id');

    protected $hidden = ['ratings'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'players';

    public function sport() {
        return $this->belongsTo('Sport');
    }

    public function ratings() {
        return $this->hasMany('Rating');
    }

    public function games() {
        return $this->belongsToMany('Game');
    }

    public function getUrlAttribute() {
        return URL::route('players.show', $this->id);
    }

    // finds the average for a particular skill if given
    // otherwise finds average for all skills
    public function rate($skill_id = null) {
        if ( !is_null($skill_id) && $skill_id instanceof Skill )
            $skill_id = $skill_id->id;

    	return $skill_id
    		? $this
    			->ratings()
    			->whereSkillId($skill_id)
    			->avg('value')
    		: $this
    			->ratings()
    			->avg('value');
    }

    // same as above but restricted to a game
    public function ratePerGame($game_id, $skill_id = null) {
    	return $skill
    		? $this
    			->ratings()
    			->whereSkillId($skill_id)
    			->whereGameId($game_id)
    			->avg('value')
    		: $this
    			->ratings()
    			->whereGameId($game_id)
    			->avg('value');
    }

    // return a list of ids of all skills a player has been rated on
    public function getRatedSkills() {
    	$skillIdsCollection = $this
    		->ratings()
    		->distinct('skill_id')
    		->get(['skill_id']);

        $skillIds = [];
        foreach ($skillIdsCollection as $skillsId) {
            $skillIds[] = $skillsId->skill_id;
        }

        return Skill::whereIn('id', $skillIds)->orderBy('name')->get();
    }

    // returns an array of averages for all skills a player is rated on
    public function getRatingSummary() {
    	$ratedSkills = $this->getRatedSkills();

		$averages = [];
		foreach ($ratedSkills as $skill) {
			$averages[$skill->name] = $this->rate($skill->id);
		}

		return $averages;
    }

    // search by player name, splits on '+'
	public static function search($searchQuery) {

        $criteria = explode('+', $searchQuery);		
		
		$query = Player::orderBy('name');

		foreach($criteria as $criterion)
		{	
			$query->orWhere('name', 'LIKE', '%' . $criterion .'%');
		}    
        return $query->paginate(5);
	}


<<<<<<< HEAD
    // Retrieve all players and sort by the number of ratings(descending)
    // and cache the results for an hour
    public static function byPopularity() {
        $players = Player::with('ratings')->remember(60)->get()->sortBy(function ($player) {
=======
        $doCaching = Config::get('app.caching');

        //Retrieve all players and sort by the number of ratings(descending) and cache the results for an hour
        
        $query = Player::with('ratings');

        if ($doCaching) {
            $query = $query->remember(60);
        }

        $players = $query->get()->sortBy(function ($player) {
>>>>>>> 816389459a11b1081cff62a898d7fd0b1162a0a5
            return $player->ratings->count();
        }, SORT_REGULAR, true);

        return $players;
    }
}
 
