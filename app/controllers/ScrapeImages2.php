<?php

class ScrapeImages2 extends \BaseController {

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


    function scrapePage($image_url){
        // create curl resource 
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, $image_url); 

        curl_setopt($ch, CURLOPT_VERBOSE, true);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36');

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 20); //timeout in seconds

        // $output contains the output string 
        $output = curl_exec($ch); 



        // close curl resource to free up system resources 
        curl_close($ch);



        return $output;
    }

    function getImgSource($name){
        $name = str_replace(' ', '_', $name);
        // TODO: urlencode????

        $html = scrapePage('http://en.wikipedia.org/wiki/'. $name);

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $src = $xpath->evaluate("string(/img[@class='photo']/@src)");

        if(!(strpos($src, "Disambig", 0))){
            return "http:".$src;
        } else {
            return getImgSource($name . " (footballer)");
        }
    }

        function getImgSourceYahoo($html){

        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $src = $xpath->evaluate("string(//tr/td/a/img/@src)");

        if(!(strpos($src, "Disambig", 0))){
            return "http:".$src;
        } else {
            return getImgSource($name . " (footballer)");
        }
    }

    function downloadImgFromSource($filename, $url) {
        $fp = fopen($filename, 'w');

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36');
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);


        fclose($fp);
    }

    function getImagesForPlayers($players){
        foreach ($players as $key => $value) {
            echo( $key." ".$value."\n");
            downloadImgFromSource($value, $key);
        }
    }

    // $players = [
    //     '1' => 'Steven Gerrard',
    //     '2' => 'Roberto Soldado',
    //     '3' => 'Hugo Lloris',
    //     '4' => 'Harry Kane'
    // ];

    // getImagesForPlayers($players);

    // echo downloadImgFromSource('Steven Gerrard', 1) . "\n";
    // echo downloadImgFromSource('Roberto Soldado',2) . "\n";
    // echo downloadImgFromSource('Hugo Lloris', 3) . "\n";
    // echo downloadImgFromSource('Harry Kane', 4) . "\n";


    public function foo() {

		$STDERR = fopen('php://stderr', 'w+');
  		fwrite($STDERR, "some debug info\n");

    	set_time_limit(0);
    	echo 'fi';
		$league = League::whereName('Barclays Premier League')->first();
		Log::info($league->name);
        foreach ($league->teams()->get() as $team) {
        	Log::info($team->name);
	        foreach ($team->lastKnownPlayers()->get() as $player)
			//$player = Player::find(1752); // John Terry
	        {

	        	if (!$player->name ||  $player->name == ' ') {
	        		continue;
	        	}
				Log::info($player->name);
				fwrite($STDERR, $player->name . "\n");


	        	$filename = "C:/wamp/www/ratingsAggreGator/public/images/profile_images/" . $player->id . ".jpg";
	            echo $filename . "<br/>";
	            if (file_exists($filename)) {
	            	fwrite($STDERR, "Already have player image -- continuign...\n");
	            	continue;
	            }

				// https://uk.eurosport.yahoo.com/football/players/hugo-lloris/

				sleep(5);

	            $url  = "https://uk.eurosport.yahoo.com/football/players/" .
	            	urlencode(str_replace(" ", "-", (strtolower($player->name)))) . "/";
	            echo $url;
	            fwrite($STDERR, $url . "\n");
	            $pageHTML = $this->scrapePage($url);
	            echo "<pre>";
	            //echo $pageHTML;
	            echo "</pre>";
				 $matches = null;
				preg_match('`s1.yimg.com/bt/api/res[^"]+.jpg`', $pageHTML, $matches);
				var_dump($matches);
				if (count($matches) == 0) {
					echo "skipping " . $player->name;
					continue;
				}

				sleep(5);

				$url = 'https://'. $matches[0];
				fwrite($STDERR, $url);

				try {


					$this->downloadImgFromSource($filename, $url);
				} catch (Exception $e) {
					fwrite($STDERR, "skipping " . $player->name . " exception on imagedownload");
				}
	            //$this->getImgSourceYahoo($pageHTML);
	        }
	    }

    }
} // end class

