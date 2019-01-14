<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public $table = 'file';
    public $timestamps = false;

    protected $fillable = ['name', 'size', 'file', 'mail_id'];
}
