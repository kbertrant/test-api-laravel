<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'likeable_id',
        'likeable_type',
        'user_id'
    ];

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function beats()
    {
        return $this->morphedByMany(Beat::class, 'likeable');
    }
}
