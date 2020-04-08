<?php


namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Tests extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password'
    ];
}