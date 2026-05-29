<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;    

    protected $table = 'productos';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'sku',
        'precio',
        'stock',
        'disponible'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'disponible' => 'boolean'
    ];

    /* Relacion N-1 con l tabla categorias */
    public function categorias(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
