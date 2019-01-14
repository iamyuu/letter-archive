<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forward extends Model
{
    public $table = 'disposition';
    public $timestamps = false;

    protected $dates = ['disposition_at', 'reply_at'];

    protected $fillable = [
    	'disposition_at', 'reply_at', 'status', 'read_unread',
        'description', 'user_id', 'mail_id'
    ];

    public function mail()
    {
    	return $this->belongsTo(Letter::class);
    }

    public function read()
    {
        if ($this->read_unread == 0) {
            return 'Belum dibaca';
        } else {
            return 'Dibaca';
        }
    }

    public function user()
    {
        return $this->belongsTo(Role::class);
    }
}
