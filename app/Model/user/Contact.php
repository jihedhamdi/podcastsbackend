<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact  extends Model
{
    use HasFactory;
    public $fillable = ['name', 'email', 'subject', 'message'];
}
