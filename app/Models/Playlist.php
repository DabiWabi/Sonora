<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = ['titulo', 'artista', 'barras'];
    protected $casts = ['barras' => 'array'];

    public function tracks() { return $this->belongsToMany(Track::class); }

    public function getDuracionAttribute(): string
    {
        $s = $this->tracks->sum('dur');
        $h = intdiv($s, 3600); $m = intdiv($s % 3600, 60);
        return $h > 0 ? sprintf('%d:%02d:%02d', $h, $m, $s % 60) : sprintf('%02d:%02d', $m, $s % 60);
    }
}
