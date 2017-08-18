<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $table = 'winners';

	protected $fillable = ['user_id', 'competition_id', 'score'];
}
