<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
  use HasFactory;
  protected $table = 'matter';
  protected $fillable = [
    'code',
    'name',
    'description'
  ];
  public $timestamps = false;
}
