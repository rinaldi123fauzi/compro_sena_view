<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'slug',
    'excerpt',
    'content',
    'image',
    'category',
    'featured',
    'published_at',
    'status'
  ];

  protected $casts = [
    'featured' => 'boolean',
    'published_at' => 'datetime',
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($news) {
      if (empty($news->slug)) {
        $news->slug = Str::slug($news->title);
      }
    });

    static::updating(function ($news) {
      if ($news->isDirty('title')) {
        $news->slug = Str::slug($news->title);
      }
    });
  }

  public function scopePublished($query)
  {
    return $query->where('status', 'published');
  }

  public function scopeFeatured($query)
  {
    return $query->where('featured', true);
  }

  public function scopeByCategory($query, $category)
  {
    return $query->where('category', $category);
  }

  public function getFormattedDateAttribute()
  {
    return $this->published_at ? $this->published_at->format('d F Y') : '';
  }

  public function getExcerptAttribute($value)
  {
    return $value ?: Str::limit(strip_tags($this->content), 200);
  }
}
