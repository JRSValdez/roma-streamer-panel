<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SorteoCodigo extends Model
{
    use HasFactory;

    protected $table = 'sorteo_codigo';
	protected $primaryKey = 'id_sorteo_codigo';
	public $timestamps = false;
}
