<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Entry extends Model
{
    protected $fillable = ['start', 'end', 'project_id'];

}
