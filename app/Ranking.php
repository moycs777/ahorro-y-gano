<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'rankings';

	protected $fillable = ['user_id', 'competition_id', 'sum'];
}
