<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed deleted_at
 * @property mixed active
 */
class IssuePriority extends Model
{
    //
    use SoftDeletes;

    protected $attributes = [
        'active' => true,
    ];

    protected $guarded = [];
}
