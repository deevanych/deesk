<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $array, array $array1, array $array2)
 */
class Notification extends Model
{
    //
    protected $guarded = [];

    public function getUnreadCount() {
        return Auth::user()->notifications->where('is_read', '=', false)->count();
    }

    public function activity() {
        return $this->belongsTo('App\Activity');
    }
}
