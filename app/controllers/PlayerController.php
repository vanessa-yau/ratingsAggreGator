<?php

class PlayerController extends \BaseController {

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
		// get all inputs from form
		$playerData = Input::only(
			'player_id',
			'originating_ip'
		);

		$ratingsData = Input::only(
			'shooting',
			'passing',
			'dribbling',
			'speed',
			'tackling'
		);


        $validator = Validator::make($ratingsData, [
            'shooting' => 'required|numeric|digits_between:1,5',
            'passing'  => 'required|numeric|digits_between:1,5',
            'dribbling'  => 'required|numeric|digits_between:1,5',
            'speed'  => 'required|numeric|digits_between:1,5',
            'tackling'  => 'required|numeric|digits_between:1,5'
        ]);

        if ($validator->fails()) {
            return Response::json( $validator->messages(), 400);
        } else {
        	foreach ($ratingsData as $skill => $value) {
	            $rating = DB::table('ratings')->insert([
		            'originating_ip'     => $_SERVER['REMOTE_ADDR'],
		            'player_id'     => $playerData['player_id'],
		            'attribute' => $skill,
		            'value' => $value,
		            'game_id' => 1
		        ]);
        	}
        	return Redirect::to('/');
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

	// Method to serve the image relating to the sports player
	public function getImg($id) {
		$player = Player::find($id);

		return Response::make(
			File::get($player->profile_image_path), 	// the bytes read from the PDF
			200, 						// the HTTP status code
			['Content-Type' => 'image/jpg']  // an array of HTTP headers - cause the browser to interpret the file as jpg
			);

	}


}
