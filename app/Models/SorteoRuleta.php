<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SorteoRuleta extends Model
{
    use HasFactory;
    protected $table = 'sorteo_ruleta';
	protected $primaryKey = 'id_sorteo_ruleta';
	public $timestamps = false;
}
