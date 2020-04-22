<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{
    //
    protected $with = ['icon', 'color'];
    protected $hidden = ['icon_id', 'color_id'];

    public function icon()
    {
        return $this->hasOne('App\IssueStatusIcon', 'id', 'icon_id');
    }

    public function color()
    {
        return $this->hasOne('App\IssueStatusColor', 'id', 'color_id');
    }
}
