<?php
use Carbon\Carbon;


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
        return $this->belongsTo('League', 'last_known_league_id');
    }

    public function getUrlAttribute() {
    return URL::route('teams.show', [
            $this->id,
        Str::slug($this->name)
        ]);
    }

    // laravel magic call using $team->badge_image_url
    // public function getBadgeImageUrlAttribute($url = null) {
    //     return $url
    //         ? $url
    //         : "/images/gator.jpg";
    // }

    // get the average ratings for each team member
    public function getAverageRatings(){
        //
    }

    public function getRankedPlayers() {
        // Note backticks accepted in mysql
        // for <<<EOT ... EOT (like double quotes)
        // see http://php.net/manual/en/language.types.string.php
        // param1 is sql query, param2 is ? args
        // table names must be completely in lower case
        $results = DB::select(
            <<<EOT
                SELECT 
                    player_id, 
                    sum(value)/count(1) as `mean_rating`, 
                    player_name
                FROM   
                ( 
                    SELECT  
                        players.id as `player_id`, 
                        ratings.value, 
                        ratings.id as `ratings.id`,
                        players.name as `player_name`
                    FROM players
                    /* use left outer join to get rated and unrated entries */
                    /* in the ratings table for this team */
                    LEFT OUTER JOIN ratings
                    ON ratings.player_id = players.id
                    WHERE players.last_known_team = ?
                ) AllRatingsForliverpoolPlayers 
                /* alias above required for returning table in subquery */
                GROUP BY player_id
                ORDER BY mean_rating DESC
EOT
, [$this->id]
        );
        
        // THIS WILL BECOME VERY SLOW WITH LOTS OF RATINGS --- WE CAN CACHE IT
        $teamRank = $this->name."AggregatePlayerRanks";
        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put($teamRank, $results, $expiresAt);
        return $results;
    }

    public function getTotalNumRatings() {
        //
    }

    //returns a list of all teams stored in the database
    public static function getList() {
        $teams = DB::table('teams')
            ->orderBy('name')
            ->get();
        return $teams;
    }
}
