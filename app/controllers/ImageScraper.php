<?php

class ImageScraper extends \BaseController {

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
		//
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

	public static function getImgSource($image_url){
	    // create curl resource 
	    $ch = curl_init(); 

	    // set url 
	    curl_setopt($ch, CURLOPT_URL, $image_url); 

	    //return the transfer as a string 
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

	    // $output contains the output string 
	    $output = curl_exec($ch); 

	    // close curl resource to free up system resources 
	    curl_close($ch);

	    echo $output;

	    // find the div containing the image link...
	    // $src = $hostInfo['img_src'];
	    // $start = strpos($output, $src) + strlen($src);
	    // $end = strpos($output, $hostInfo['img_end'], $start);

	    // $imgPath = substr($output, $start, $end - $start);
	    // return $imgPath;
	}

    public static function scrape() {
        ImageScraper::getImgSource('http://www.bing.com/images/search?q=steven+gerrard');
    }

}
