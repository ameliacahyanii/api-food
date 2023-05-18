<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'foods';
    protected $fillable = ['food_name', 'food_type', 'recipe_content', 'author', 'image'];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
    
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'food_id', 'id');
    }
}
