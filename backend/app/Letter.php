<?php

namespace App;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use Userstamps, SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['start_date', 'expired_date'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
