<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model {

	public function scopePage($query, $url){
        return $query->where('url', $url);
    }

}
