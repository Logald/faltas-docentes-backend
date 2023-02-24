<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gmp extends Model
{
  use HasFactory;
  protected $table = 'gmp';
  protected $fillable = [
    'mgId',
    'proffessorId'
  ];
  public $timestamps = false;
}
