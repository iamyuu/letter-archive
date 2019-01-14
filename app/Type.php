<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $table = 'mail_type';
    public $timestamps = false;

    protected $fillable = ['type'];
}
