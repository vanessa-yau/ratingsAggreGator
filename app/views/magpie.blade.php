<?php
function getRss($sport){
    require_once(public_path().'/packages/magpierss/rss_fetch.inc');

    $url = "http://feeds.bbci.co.uk/sport/0/$sport/rss.xml?edition=uk";
    $rss = fetch_rss($url);

    // echo "Site: ", $rss->channel['title'], "<br>\n";
    foreach ($rss->items as $item ) {
        $title = $item['title'];
        $url   = $item['link'];
        echo "<a href=$url target='_blank'>$title</a>&nbsp&nbsp|&nbsp&nbsp";
    }
}