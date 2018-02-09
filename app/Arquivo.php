<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arquivo extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'hash',
		'originalName',
		'local',
		'mimeType',
		'size'
	];
    protected $dates = ['deleted_at'];
}
