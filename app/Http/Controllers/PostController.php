<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function post()
    {
        $posts = Post::all();
        return view('subpage.blog', compact('posts'));
    }


    //Tworzy post
    public function create()
    {
        return view('subpage.createBlogs');
    }


    //Zapisuje post do bazy
    public function store(Request $request)
{
    // Walidacja danych wejściowych
    $validatedData = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif', // przykładowa walidacja dla zdjęcia
    ]);

    // Zapisanie danych obrazka do bazy danych
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $imageData = file_get_contents($image->getRealPath());
    $validatedData['image'] = $imageData;
}


    // Przypisanie ID zalogowanego użytkownika do pola 'user_id'
    $validatedData['user_id'] = Auth::id();

    // Zapisanie posta do bazy danych
    Post::create($validatedData);

    return redirect()->route('blog')->with('success', 'Post został pomyślnie dodany.');
}


}
