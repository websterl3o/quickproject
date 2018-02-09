<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Http\UploadedFile;

class Task extends Model
{
	use SoftDeletes;
    protected $fillable = [
        'nome',
        'descricao',
        'status'
    ];
    protected $dates = ['deleted_at'];
}
