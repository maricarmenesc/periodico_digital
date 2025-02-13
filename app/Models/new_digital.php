<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class new_digital extends Model
{
    use HasFactory;

    protected $table = 'noticias'; // Asegura que coincide con la BD
    protected $primaryKey = 'id_noticia';
    protected $fillable = ['titulo', 'id_autor', 'fecha_hora', 'encabezado', 'texto'];
}
