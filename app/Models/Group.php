<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  use HasFactory;
  protected $table = 'group';
  protected $fillable = [
    'grade',
    'name',
    'turnId'
  ];
  public $timestamps = false;
}
