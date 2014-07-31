<?php
/**
 * JARI.IO
 * Date: 29-7-14
 * Time: 23:10
 */

namespace Trapped;

use Config, Cache;
class Radio {
    protected $url;
    protected $airtimeurl;

    public function __construct() {
        $this->url = Config::get("trapped.radio_url");
        $this->airtimeurl = Config::get("trapped.airtime_url");

        if(Cache::has("radio_stats")) $stats = Cache::get("radio_stats");
        else {
            $curl = new \Curl();
            $resp = $curl->get($this->url);
            if(!$curl->error) {
                $stats = json_decode($curl->response, true);
                if(json_last_error() != 0) throw new \Exception("Unable to decode radio server response: ".json_last_error_msg());
                Cache::put("radio_stats", $stats, Config::get("trapped.radio_cache_age"));
            } else throw new \Exception("Radio server fail: ".$curl->error_message);
        }

        if(Cache::has("airtime_stats")) $airtime = Cache::get("airtime_stats");
        else {
            $curl = new \Curl();
            $resp = $curl->get($this->airtimeurl);
            if(!$curl->error) {
                $airtime = json_decode($curl->response, true);
                if(json_last_error() != 0) throw new \Exception("Unable to decode airtime server response: ".json_last_error_msg());
                Cache::put("airtime_stats", $airtime, Config::get("trapped.radio_cache_age"));
            } else throw new \Exception("Airtime server fail: ".$curl->error_message);
        }

        $this->listeners = $stats["mounts"]["/TRAPPED"]["listeners"];

        if(isset($airtime["current"]["name"])) $this->current_song = $this->prev = $airtime["current"]["name"];
        else $this->current_song = $stats["mounts"]["/TRAPPED"]["current_song"];

        if(isset($airtime["previous"]["name"])) $this->prev = $airtime["previous"]["name"];
        if(isset($airtime["next"]["name"])) $this->next = $airtime["next"]["name"];

        if(isset($airtime["currentShow"][0]["name"])) $this->current_show = $airtime["currentShow"][0]["name"];
        if(isset($airtime["nextShow"][0]["name"])) $this->next_show = $airtime["nextShow"][0]["name"];
    }

    public $listeners;
    public $current_song;
    public $prev;
    public $next;
    public $current_show;
    public $next_show;

    public function api() {
        return [
            "listeners" => $this->listeners,
            "current_song" => $this->current_song,
            "prev" => $this->prev,
            "next" => $this->next,
            "current_show" => $this->current_show,
            "next_show" => $this->next_show
        ];
    }
} 