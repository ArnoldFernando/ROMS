<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class File extends Model
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
    public function archivedFiles()
    {
        return $this->hasMany(ArchivedFile::class);
    }


    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['document_code', 'subject', 'originating_office'])
            ->logOnlyDirty() // Optional: logs only if values actually changed
            ->useLogName('file')
            ->setDescriptionForEvent(fn(string $eventName) => "File has been {$eventName}");
    }
}
