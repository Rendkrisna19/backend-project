<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','author','isbn','year','stock','cover_path'];

    // otomatis turut dikirim ke JSON
    protected $appends = ['cover_url'];

    // URL publik untuk <img src>
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_path) {
            return asset('storage/'.$this->cover_path);
        }
        // fallback default cover
        return asset('storage/covers/default.jpg');
    }
}
