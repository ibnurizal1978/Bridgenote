<?php

namespace App\Models;

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{

    use HasApiTokens;

    protected $table = 'tbl_users';
    protected $fillable = array('email', 'password');
    public $timestamps = true;
    public static $rules = array();
}
