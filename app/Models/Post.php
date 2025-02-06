<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [ // data apa saya yang boleh diisi
        "title",
        "content",
    ];

    public static function boot() {
        parent::boot();

        // kalau creating akan dibuat slugnya BERSAMAAN dgn datanya, tapi kalau created akan dibuat dulu datanya baru di buat slugnya (2 kali proses)
        static::creating(function ($post) {
            $post->slug = str_replace(' ', '-', $post->title); // spasi akan direplace dengan strip
        });
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id', 'id'); // class Post direlasikan ke dalam class Comment. satu post memiliki banyak (hasMany) comment
    }

    public function total_comments() { // menghitung jumlah komen
        return $this->comments()->count();
    }

    public function scopeActive($query) {
        return $query->where("active", true); // query builder ini akan di panggil di PostController
    }

    protected $table = 'post'; // Nama tabel di database. kalau nama tablenya udah plural, nggak perlu didefinisi seperti ini


}
