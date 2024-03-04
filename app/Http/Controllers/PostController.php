<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function post()
    {
        $posts = Post::all();
        return view('subpage.blog', compact('posts'));
    }

    // Tworzy post
    public function create()
    {
        return view('subpage.createBlogs');
    }

    // Zapisuje post do bazy
    public function store(Request $request)
    {
        // Walidacja danych wejściowych
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // przykładowa walidacja dla zdjęcia
        ]);

        // Zapisanie ścieżki obrazka do bazy danych
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validatedData['image'] = $imagePath;
        }

        // Przypisanie ID zalogowanego użytkownika do pola 'user_id'
        $validatedData['user_id'] = Auth::id();

        // Zapisanie posta do bazy danych
        Post::create($validatedData);

        return redirect()->route('blog')->with('success', 'Post został pomyślnie dodany.');
    }

    // Wyświetla posty użytkownika
    public function userPosts()
    {
        // Pobierz obecnie zalogowanego użytkownika
        $user = Auth::user();

        // Pobierz posty dodane przez obecnego użytkownika
        $posts = $user->posts;

        return view('subpage.user-posts.userposts', compact('posts'));
    }

     // Wyświetla formularz edycji posta
     public function edit($id)
     {
         $post = Post::findOrFail($id);
 
         return view('subpage.user-posts.edit-post', compact('post'));
     }

    // Aktualizuje dane posta
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'new_image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('new_image')) {
            Storage::delete($post->image);
            $imagePath = $request->file('new_image')->store('public/images');
            $validatedData['image'] = $imagePath;
        }

        $post->update($validatedData);

        return redirect()->route('blog')->with('success', 'Post został pomyślnie zaktualizowany.');
    }


    // Usuwa post
    public function destroy($id)
    {
        // Znajdź post o podanym identyfikatorze
        $post = Post::findOrFail($id);


    // Sprawdź, czy użytkownik jest właścicielem posta lub administratorem
    if (Auth::id() !== $post->user_id && !auth()->user()->hasRole('administrator')) {
        return redirect()->back()->with('error', 'Nie masz uprawnień do usunięcia tego posta.');
    }

        // Usuń post
        $post->delete();

        return redirect()->route('blog')->with('success', 'Post został pomyślnie usunięty.');
    }

    public function allPosts()
{
    // Pobierz wszystkie posty
    $posts = Post::paginate(10);

    // Przekazanie danych do widoku
    return view('subpage.user-posts.allposts', ['posts' => $posts]);
}
}
