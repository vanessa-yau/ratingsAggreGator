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

        // find the div containing the image link...
        // $src = $hostInfo['img_src'];
        // $start = strpos($output, $src) + strlen($src);
        // $end = strpos($output, $hostInfo['img_end'], $start);

        // $imgPath = substr($output, $start, $end - $start);
        // return $imgPath;
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

function downloadImgFromSource($name, $id, $url) {
    $fp = fopen($id.'.jpg', 'wb');
    echo $url;

    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $data = curl_exec($ch);
    var_dump($data);
    curl_close($ch);
    fclose($fp);
}

// echo downloadImgFromSource("thing", 1, "http://news.bbcimg.co.uk/media/images/79309000/jpg/_79309867_ccb0d2b1-a311-473b-8309-6a5bea083204.jpg");

echo downloadImgFromSource('Steven Gerrard', 1) . "\n";
echo downloadImgFromSource('Roberto Soldado', 1) . "\n";
echo downloadImgFromSource('Hugo Lloris', 1) . "\n";
echo downloadImgFromSource('Harry Kane', 1) . "\n";

