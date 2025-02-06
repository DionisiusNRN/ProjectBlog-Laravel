<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function comments() {
        // SELECT * FROM comments WHERE <nama_class>_id (jadinya post_id)
        // satu post memiliki banyak (hasMany) comment
        return $this->hasMany(Comment::class, 'post_id'); // class Post direlasikan ke dalam class Comment
    }

    public function scopeActive($query) {
        return $query->where("active", true); // query builder ini akan di panggil di PostController
    }

    // kalau nama tablenya udah plural, nggak perlu didefinisi seperti di bawah
    protected $table = 'post'; // Nama tabel di database
    protected $primaryKey = 'id';


}
