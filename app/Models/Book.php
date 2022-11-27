<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'options->enabled',
    ];

    /**
     * Get the Category associated with the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Category(): HasOne
    {
        return $this->hasOne(Cateory::class, 'id', 'category_id');
    }

    /**
     * Get the Cita that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Cita(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'book_id', 'id');
    }

}
