<?php
// http://forumsarchive.laravel.io/viewtopic.php?id=6284
class PageCounter extends Eloquent {
    protected $guarded = array('id');
    protected $table = "page_counter";

    public static function getCounter( $url = false )
    {
        // By default look for the URI of the page currently being visited
        if($url == false) $url = URL::current();
        $counter = static::whereUrl( $url )->first();
        return $counter ?: new PageCounter(['url' => $url ]);
    }

    public static function plusOne()
    {
        $counter = static::getCounter();
        $counter->counter += 1;
        $counter->save();
    }
}