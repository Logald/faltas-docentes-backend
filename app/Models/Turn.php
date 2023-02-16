<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
  use HasFactory;

  protected $table = 'turn';
  protected $fillable = [
    "name"
  ];
  public $timestamps = false;
}
