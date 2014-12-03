<?php
function scrapePage($image_url){
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

    return $output;
}

function getImgSource($name){
    $name = str_replace(' ', '_', $name);
    // TODO: urlencode????

    $html = scrapePage('http://en.wikipedia.org/wiki/'. $name);

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

function downloadImgFromSource($name, $id) {
    $fp = fopen(public_path().'/images/profile_images'.$id.'.jpg', 'wb');
    $url = getImgSource($name);

    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, false);
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

$players = [
    '1' => 'Steven Gerrard',
    '2' => 'Roberto Soldado',
    '3' => 'Hugo Lloris',
    '4' => 'Harry Kane'
];

getImagesForPlayers($players);

// echo downloadImgFromSource('Steven Gerrard', 1) . "\n";
// echo downloadImgFromSource('Roberto Soldado',2) . "\n";
// echo downloadImgFromSource('Hugo Lloris', 3) . "\n";
// echo downloadImgFromSource('Harry Kane', 4) . "\n";