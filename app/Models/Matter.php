<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    use HasFactory;

    protected $casts = [
        'public_at' => 'datetime',
    ];

    protected $fillable = [
        'type',
        'name',
        'slug',
        'external_url',
        'content',
        'public_at',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query
            ->whereNotNull('public_at')
            ->where('public_at', '>=', now()->toDateString());
    }
}
