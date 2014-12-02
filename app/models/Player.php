<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Collection;

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

    public function lastKnownTeam() {
        return $this->belongsTo('Team', 'last_known_team');
    }

    public function getUrlAttribute() {
        return URL::route('players.show', $this->id);
    }

    public function getImageUrlAttribute($url = null) {
        return $url 
            ? $url
            : "/images/profile_images/placeholder.png";
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

        return count($skillIds) 
            ? Skill::whereIn('id', $skillIds)->orderBy('name')->get()
            : new Collection;
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
        return $query->paginate(6);
	}


    // Retrieve all players and sort by the number of ratings(descending)
    // and cache the results for an hour
    public static function byPopularity() {
        $doCaching = Config::get('app.caching');

        $query = Player::with('ratings');
        if ($doCaching) {
            $query = $query->remember(60);
        }

        $players = $query->has('ratings', '>', 0)->get()->sortBy(function ($player) {
            return $player->ratings->count();

        }, SORT_REGULAR, true);

        return $players;
    }

    public static function mostPopular() {
        // retrieve all players and sort by the number of ratings
        $players = Player::byPopularity();

        // restrict the list to the top 10
        $players = $players->slice(0,9);
        return $players;
    }
}
 
