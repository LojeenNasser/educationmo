<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['series_id', 'name', 'slug', 'episode', 'duration', 'intro', 'video_code', 'video_url', 'pdf_file', 'web_link'];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}
