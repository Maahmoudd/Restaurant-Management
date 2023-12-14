<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'location', 'contact_info',
    ];

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
