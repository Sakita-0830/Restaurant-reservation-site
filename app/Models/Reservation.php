<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model{
    use HasFactory;

    protected $fillable = ['users_id', 'shops_id', 'start_at', 'num_of_people'];

}
