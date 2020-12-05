<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
	protected $table = 'codigos';
	protected $primaryKey = 'id_codigo';
    use HasFactory;
}
