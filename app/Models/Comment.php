<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id'); // pastikan foreign key benar
    }
    protected $table = 'post'; // Nama tabel di database
}
