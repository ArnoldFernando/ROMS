<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function archivedFiles()
    {
        return $this->hasMany(ArchivedFile::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
