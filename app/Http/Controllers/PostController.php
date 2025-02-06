<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // NAMA TABLE SEHARUSNYA PLURAL (POSTS)
    public function index() // menampilkan semua
    {
        // active() adalah query scope dari App\Model\Post yaitu scopeActive()
        // withTrashed() adalah scope bawaaan dari SoftDeletes
        $posts = Post::active()->withTrashed()->get();
        $view_data = [
            'posts' => $posts,
        ];

        return view("posts.index", $view_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // untuk create data lalu submit ke store
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // untuk menyimpan data baru
    {
        // membaca request yag dikirimkan client/browser
        $title = $request->input("title");
        $content = $request->input("content");

        // Post::insert([ // insert diganti create
        Post::create([ // sesuaikan dgn nama tabelnya
            // field apa saja yg ingin diisi
            "title"=> $title,
            "content"=> $content,
            // // created dan updated dihapus karena dengan create akan otomatis dibuat
            // "created_at" => date("Y-m-d H:i:s"),
            // "updated_at"=> date("Y-m-d H:i:s")
        ]);

        return redirect("posts");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // menampilkan detail / salah satu data saja
    {
        $post = Post::where('id', $id)->first(); // mendapatkan data paling pertama dari query diatasnya (single data, dan harus unik where nya)
        // $post = Post::find($id); // debugging
        // dd($post); // debugging

        $comments = $post->comments()->get(); // dd($post->comments()->toSql()); // debugging

        $total_comments = $post->total_comments(); // yang boleh pakai :: adalah static function

        $view_data = [
            "posts"=> $post,
            "comments" => $comments,
            "total_comments"=> $total_comments,
        ] ;
        return view('posts.show', $view_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) // menampilkan formnya
    {
        // sama kayak method show bagian ini terus filenya bisa duplikat dari create.blade.php
        $post = Post::where('id', '=', $id)->first(); // mendapatkan data paling pertama dari query diatasnya (single data, dan harus unik where nya)

        $view_data = [
            "post"=> $post
        ] ;
        return view("posts.edit", $view_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // melakukan action perubahannya
    {
        $title = $request->input("title");
        $content = $request->input("content");

        Post::where("id", $id) // defaultnya adalah ('id', '=', $id) kalau mau selain sama dengan, maka perlu ditulis operatornya
                ->update([
                "title"=> $title,
                "content"=> $content,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect("posts/{$id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::where("id", $id)->delete();

        return redirect("posts");
    }
}
