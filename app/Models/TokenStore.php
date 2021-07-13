<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TokenStore extends Model
{
    //
    protected $table= 'token_store';
    protected $primaryKey='id_token_store';
    public $timestamps=false;
    protected $fillable= [
        'access_token',
        'refresh_token',
        'token_expires'
    ];

    public function user()
    {
    	return $this->belongsTo(User::Class, 'id');
    }
}
