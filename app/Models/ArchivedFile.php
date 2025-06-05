<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_code',
        'subject',
        'originating_office',
        'remarks',
        'file',
        'date',
        'folder_id',
        'user_id',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
