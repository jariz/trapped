<?php
/**
 * JARI.IO
 * Date: 29-7-14
 * Time: 1:50
 */

namespace Model;


/**
 * Model\Subreddit
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property string $label
 * @property integer $id
 * @property \Carbon\Carbon $deleted_at
 */
class Subreddit extends \Eloquent {
    protected $softDelete = true;
    public $timestamps = true;
    protected $table = "subreddits";

    public static  function formatted() {
        $subs = self::all();
        $out = [];
        foreach($subs as $sub) {
            /* @var $sub Subreddit */
            $out[$sub->label] = $sub->name;
        }
        return $out;
    }
} 