<?php
/**
 * JARI.IO
 * Date: 29-7-14
 * Time: 3:30
 */

namespace Model;


/**
 * Model\Exclusive
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property string $slug
 * @property string $desc
 * @property string $art
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $download
 */
class Exclusive extends \Eloquent {
    protected $softDelete = true;
    public $timestamps = true;
    protected $table = "exclusives";

    public static function boot() {
        parent::boot();
        Exclusive::saving(function(Exclusive $exclusive) {
            $curl = new \Curl();
            $resp = $curl->get("https://api.soundcloud.com/resolve.json?client_id=b45b1aa10f1ac2941910a7f0d10f8e28&url=".$exclusive->link);
            if($resp == 0) {
                $f = json_decode($curl->response);
                if(isset($f->location)) {
                    if($curl->get($f->location) == 0) {
                        $f = json_decode($curl->response);
                        if(isset($f->artwork_url)) {
                            $exclusive->art = $f->artwork_url;
                        } else if(isset($f->user->avatar_url)) {
                            $exclusive->art = $f->user->avatar_url;
                        }
                    }
                }
            }
        });
    }
} 