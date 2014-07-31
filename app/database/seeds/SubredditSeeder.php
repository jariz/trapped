<?php
/**
 * JARI.IO
 * Date: 29-7-14
 * Time: 2:01
 */
use \Model\Subreddit;
class SubredditSeeder extends Seeder{
    public function run() {
        Subreddit::truncate();

        $subreddit = new Subreddit();
        $subreddit->label= "Trap";
        $subreddit->name = "trap";
        $subreddit->save();

        $subreddit = new Subreddit();
        $subreddit->label = "Trap Muzik";
        $subreddit->name = "trapmuzik";
        $subreddit->save();

        $subreddit = new Subreddit();
        $subreddit->label = "Twerk Trap";
        $subreddit->name = "twerkmusic";
        $subreddit->save();

        $subreddit = new Subreddit();
        $subreddit->label = "Club";
        $subreddit->name = "clubmuzik";
        $subreddit->save();
    }
} 