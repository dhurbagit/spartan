<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Opt-in list of relations that should be deleted via Eloquent
     * BEFORE deleting this model (so child model events run).
     * If you don't want it, remove/empty this property.
     */
    protected array $cascadeRelations = ['products'];

    public function getCascadeRelations(): array
    {
        return $this->cascadeRelations ?? [];
    }
}
