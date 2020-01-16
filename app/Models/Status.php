<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Status extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unlike()
    {
        $this->likes()->where([
            'user_id' => auth()->user()->id
        ])->delete();
    }

    public function isLiked(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }
}
