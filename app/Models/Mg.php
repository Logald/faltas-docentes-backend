<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mg extends Model
{
  use HasFactory;
  protected $table = 'mg';
  protected $fillable = [
    'matterId',
    'groupId'
  ];
  public $timestamps = false;
}
