<?php

class RatingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// get player info inputs from form
		$playerData = Input::only(
			'player_id'
		);

		// get user submitted ratings.
		$ratingsData = Input::only(
			'shooting',
			'passing',
			'dribbling',
			'speed',
			'tackling'
		);

		// validate inputs
        $validator = Validator::make($ratingsData, [
            'shooting' => 'required|numeric|digits_between:1,5',
            'passing'  => 'required|numeric|digits_between:1,5',
            'dribbling'  => 'required|numeric|digits_between:1,5',
            'speed'  => 'required|numeric|digits_between:1,5',
            'tackling'  => 'required|numeric|digits_between:1,5'
        ]);

        // if validation passes, run query to insert and return newly created rating.
        if ($validator->fails()) {
            return Response::json( $validator->messages(), 400);
        } else {
        	$ratingsArray = [];
        	foreach ($ratingsData as $skill => $value) {
	            $rating = DB::table('ratings')->insert([
		            'originating_ip'     => $_SERVER['REMOTE_ADDR'],
		            'player_id'     => $playerData['player_id'],
		            'attribute' => $skill,
		            'value' => $value,
		            'game_id' => 1,
		            'created_at' => new DateTime,
		            'updated_at' => new DateTime
		        ]);
		        array_push($ratingsArray, $rating);
        	}
        	return $ratingsArray;
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
