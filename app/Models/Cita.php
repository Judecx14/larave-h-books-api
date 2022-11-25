<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    /**
     * Get the Book associated with the Cita
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Book(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'book_id');
    }
}
