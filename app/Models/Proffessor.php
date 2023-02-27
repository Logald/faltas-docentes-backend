<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proffessor extends Model
{
  use HasFactory;

  protected $table = 'proffessor';
  protected $fillable = [
    'name',
    'lastname',
    'ci'
  ];

  public $timestamps = false;
}
