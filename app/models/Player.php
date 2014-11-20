<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Player extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $guarded = array('id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'players';

<<<<<<< HEAD
    public function ratings() {
        return $this->hasMany('Rating');
    }
=======
	public static function search($searchQuery) {

		$criteria = preg_split("/[\s,]+/", $searchQuery);
		
		$query = DB::table('players');

		foreach($criteria as $criterion)
		{	
			$query=$query->orWhere('name', 'LIKE', '%'. $criterion .'%');
			$query=$query->orWhere('name', 'LIKE', '%'. $criterion .'%');

		}    
		return $query->get();
			
	}
>>>>>>> 3cbb328bd1937f14d8f69ee41635f70f65ee44d5

}
