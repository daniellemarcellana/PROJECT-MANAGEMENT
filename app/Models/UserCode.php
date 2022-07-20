<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
class UserCode extends Model
{
    use HasFactory;
    use Loggable;
    public $table = "user_codes";
  
    protected $fillable = [
        'user_id',
        'code',
    ];
}