<?php

namespace Model;
use Curl, Cache, Log;
/**
 * Model\Thread
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $created
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $embed_thumbnail
 * @property string $embed_title
 * @property string $embed_desc
 * @property integer $votes
 * @property string $subreddit
 */
class Thread extends \Eloquent {
    protected $table = "threads";

    const HOT = "hot";
    const TOP = "top";

    public static function download($subreddit, $type) {
        if(Cache::has("{$type}_{$subreddit}")) {
            Log::info("Not downloading new threads because cache is too new.");
            return;
        }

        $start = time(true);
        $curl = new Curl();
        $curl->get("http://www.reddit.com/r/{$subreddit}/{$type}.json?limit=100".($type == Thread::TOP ? "&t=week" : ""));
        $data = json_decode($curl->response);

        if(!isset($data->data->children)) {
            Log::error("Couldn't connect to reddit, serving cached data!");
            //try again in a minute, don't wanna break reddit
            Cache::put("{$type}_{$subreddit}", 1, 1);
            return;
        }

        Thread::where("subreddit", "=", $subreddit)->delete();
        foreach($data->data->children as $thread) {
            $thread = $thread->data;
            switch($thread->domain) {
                case "soundcloud.com":
                    //check url (should be 2 paths /username/track)
                    $url_info = (object)parse_url($thread->url);
                    if(strpos($url_info->path, "/") > 2) {
                        Log::warning("[SCPARSER] Skipped url with path {$url_info->path}");
                        break;
                    }

                    //check for sets (no support yet)
                    $p = explode("/", $url_info->path);
                    if(isset($p[2]) && $p[2] == "sets") {
                        Log::warning("[SCPARSER] Skipped url with path {$url_info->path} (appears to be a set)");
                        break;
                    }

                    //force https
                    if($url_info->scheme != "https")
                        $thread->url = "https".substr($thread->url, strlen($url_info->scheme));

                    $th = new Thread();
                    $th->title = $thread->title;
                    $th->url = $thread->url;
                    $th->created = $thread->created;
                    if(isset($thread->media->oembed)) {
                        $embed = $thread->media->oembed;
                        try {
                            $th->embed_thumbnail = $embed->thumbnail_url;
                            $th->embed_title = $embed->title;
                            $th->embed_desc = $embed->description;
                        }
                        catch(\Exception $e) {
                            Log::warning("[SCPARSER] Unexpected embed data entry '{$th->title}'");
                        }
                    }
                    $th->subreddit = $subreddit;
                    $th->votes = $thread->score;
                    $th->save();
                    break;
                default;
            }
        }
        $time = microtime(true) - $start;
        Log::info("New threads downloaded and cached. Took {$time} ms");
        Cache::put("{$type}_{$subreddit}", 1, 5);

    }
} 