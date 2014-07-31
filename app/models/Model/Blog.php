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
 * @property integer $user_id
 * @property string $content
 */
class Blog extends \Eloquent {
    protected $softDelete = true;
    public $timestamps = true;
    protected $table = "blog";

    public function author() {
        return $this->belongsTo('Model\User', 'user_id', 'id');
    }
} 