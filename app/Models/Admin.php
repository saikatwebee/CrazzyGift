<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable; 

    protected $guard = 'admin';

    protected $fillable = [
        'email','phone', 'password','role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
?>
