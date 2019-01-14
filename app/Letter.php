<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    public $table = 'mail';
	public $primaryKey = 'id';
    public $timestamps = false;
	public $incrementing = false;

    protected $dates = ['incoming_at', 'mail_date'];

    protected $fillable = [
    	'id', 'incoming_at', 'mail_date', 'mail_code', 'mail_from',
        'mail_to', 'mail_subject', 'mail_content', 'in_out', 'user_id',
    ];

    public function from()
    {
    	if ($this->mail_from == '') {
    		return '-';
    	} else {
            return $this->mail_from;
        }
    }

    public function to()
    {
        if ($this->mail_to == '') {
            return '-';
        } else {
            return $this->mail_to;
        }
    }

    public function in_out()
    {
        if ($this->in_out == 1) {
            return 'Letter In';
        } else {
            return 'Letter Out';
        }
    }
}
