<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Jwtapi extends Model
{
     use \Illuminate\Auth\Authenticatable;
    use HasFactory;
    protected $table = 'jwtapis';
    public $incrementing = false;
    protected $keytype = 'string';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'conform_password'
    ];

   
}
