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

    public function ratings() {
        return $this->hasMany('Rating');
    }

    public function getUrlAttribute() {
        return URL::route('players.show', $this->id);
    }

    public function rate($attribute = null) {
    	return $attribute
    		? $this
    			->ratings()
    			->whereAttribute($attribute)
    			->avg('value')
    		: $this
    			->ratings()
    			->avg('value');
    }

    public function ratePerGame($game_id, $attribute = null) {
    	return $attribute
    		? $this
    			->ratings()
    			->whereAttribute($attribute)
    			->whereGameId($game_id)
    			->avg('value')
    		: $this
    			->ratings()
    			->whereGameId($game_id)
    			->avg('value');
    }

    public function getRatedAttributes() {
    	return $this
    		->ratings()
    		->distinct('attribute')
    		->orderBy('attribute')
    		->get(['attribute']);
    }

    public function getRatedAttributesAsArray() {
    	$atts = $this->getRatedAttributes();
    	$attributesArray = [];
    	foreach ($atts as $att) {
    		$attributesArray[] = $att->attribute;
    	}

    	return $attributesArray;
    }

    public function getRatingSummary() {
    	$ratedAttributes = $this->getRatedAttributesAsArray();

		$averages = [];
		foreach ($ratedAttributes as $attribute) {
			$averages[$attribute] = $this->rate($attribute);
		}

		return $averages;
    }


	public static function search($searchQuery) {

        $criteria = explode('+', $searchQuery);		
		
		$query = Player::orderBy('name');

		foreach($criteria as $criterion)
		{	
			$query->orWhere('name', 'LIKE', '%' . $criterion .'%');
		}    
        return $query->paginate(5);
	}

    public static function byPopularity() {

        $doCaching = Config::get('app.caching');

        //Retrieve all players and sort by the number of ratings(descending) and cache the results for an hour
        
        $query = Player::with('ratings');

        if ($doCaching) {
            $query = $query->remember(60);
        }

        $players = $query->get()->sortBy(function ($player) {
            return $player->ratings->count();
        }, SORT_REGULAR, true);

        return $players;
    }
}
 