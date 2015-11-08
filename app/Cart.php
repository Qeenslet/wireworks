<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = ['key', 'data'];

    public function scopeGetOld($query)
    {
        $old = \Carbon\Carbon::now()->subDays(3)->toDateTimeString();
        return $query->where('created_at', '<', $old);
    }

}
