<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed author
 */
class IssueComment extends Model
{
    //
    protected $with = ['author'];
    protected $hidden = ['author_id'];
    protected $casts = [
        'created_at' => 'datetime:d.m.Y / H:i',
    ];
    protected $appends = ['self'];

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    /**
     * @return bool
     */
    public function getSelfAttribute()
    {
        return ($this->author->id === Auth::user()->id);
    }
}
