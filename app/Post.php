<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use Wildside\Userstamps\Userstamps;

class Post extends Model
{
    use SoftDeletes, Userstamps;
}
