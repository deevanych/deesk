<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property boolean active
 */
class IssueType extends Model
{
    //
    use SoftDeletes;

    protected $attributes = [
        'active' => true,
    ];

    protected $guarded = [];
}
