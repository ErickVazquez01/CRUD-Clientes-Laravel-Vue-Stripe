<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    public $table = "pagos";
    protected $fillable = array("*");
    public $timestamps = true;

    public function clientes(){
        return $this->belongsToMany(Cliente::class,
        "cliente_pago");
    }
}
