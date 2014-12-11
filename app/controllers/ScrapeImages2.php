<?php

class ScrapeImages2 extends \BaseController {
	var $STDERR = "";

	function __construct(){
		$this->STDERR = fopen('php://stderr', 'w+');
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

    function getImgSourceYahoo($html){
        $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        // search DOM for image source inside div with class "player-image"
        $src = $xpath->evaluate("//div[@class='player-image soccer-jersey']/img/@style");
        echo "number of items found: " . $src->length;
        
        var_dump($src->item(0)->value);
        $url = substr($src->item(0)->value, strlen("background-image:url('"), -strlen("');"));

        if($src->length == 0){
        	return null;
        }
        return $url;
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

    public function foo() {
  		fwrite($this->STDERR, "some debug info\n");

    	set_time_limit(0);
    	echo 'fi';
		$league = League::whereName('Barclays Premier League')->first();
		Log::info($league->name);
        foreach ($league->teams()->get() as $team) {
        	Log::info($team->name);
	        foreach ($team->lastKnownPlayers()->get() as $player)
			//$player = Player::find(1752); // John Terry
	        {
	        	$this->bar($player);
			} // end foreach
	    } // end outer foreach
    } // end func foo

    public function test() {
    	$player = Player::find(1469);
    	$this->bar($player);
    }

	public function bar($player) {
		if (!$player->name ||  $player->name == ' ') {
			return;
		}
		Log::info($player->name);
		fwrite($this->STDERR, $player->name . "\n");

		$filename = "C:/wamp/www/ratingsAggreGator/public/images/profile_images/" . $player->id . ".jpg";
	    echo $filename . "<br/>";
	    if (file_exists($filename)) {
	    	fwrite($this->STDERR, "Already have player image -- continuing...\n");
	    	return;
	    }

		sleep(2);

	    $url  = "https://uk.eurosport.yahoo.com/football/players/" .
	    	urlencode(str_replace(" ", "-", (strtolower($player->name)))) . "/";
	    echo $url;
	    fwrite($this->STDERR, $url . "\n");
	    $pageHTML = $this->scrapePage($url);

	    $url = $this->getImgSourceYahoo($pageHTML);
	    if(!$url){return;}

		sleep(2);

		fwrite($this->STDERR, $url);

		if ($url == "https://s1.yimg.com/bt/api/res/1.2/_nOybrcUAX3KsNW8TTO3_g--/YXBwaWQ9eW5ld3M7Zmk9ZmlsbDtoPTg0O3B5b2ZmPTMwO3E9NzU7dz0xNDk-/http://l.yimg.com/os/publish-images/sports/2014-09-12/0bb7ea80-3a98-11e4-8e92-3371f128dc59_sportacular.jpg") {
			fwrite ($this->STDERR, "Skipping yahoo placeholder image...");
			continue;
		}
		try {
			$this->downloadImgFromSource($filename, $url);
		} catch (Exception $e) {
			fwrite($this->STDERR, "skipping " . $player->name . " exception on imagedownload");
		} // end catch
	    //$this->getImgSourceYahoo($pageHTML);
	} // end func bar
} // end class
