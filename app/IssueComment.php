<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed author
 * @property int issue_id
 * @property int id
 * @property mixed issue
 * @method static create($all)
 * @method belongsTo(string $string)
 * @method hasOne(string $string, string $string1, string $string2)
 * @method save()
 */
class IssueComment extends Model
{
    //
    protected $with = ['author'];
    protected $hidden = ['author_id'];
    protected $guarded = [];
    protected $appends = ['self'];

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }
    /**
     * @return bool
     */
    public function getSelfAttribute()
    {
        return ($this->author->id === Auth::user()->id);
    }
}
