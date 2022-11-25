<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedBooks extends Model
{
    use HasFactory;

    /**
     * Get all of the User for the SavedBooks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function User(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    /**
     * Get all of the Book for the SavedBooks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Book(): HasMany
    {
        return $this->hasMany(Book::class, 'id', 'book_id');
    }
}
