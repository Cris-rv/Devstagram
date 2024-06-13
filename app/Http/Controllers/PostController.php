<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // Autenticar usuario
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    // Vista de perfil de usuario
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashbord', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    // Vista de crear perfil
    public function create()
    {
        return view('posts.create');
    }

    // almacenar y validar datos de creacion de publicacion
    public function store(Request $request) 
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required|max:300',
            'imagen' => 'required'
        ]);

        Post::create([
           'titulo' => $request->titulo,
             'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);

        //Otra forma de almacenar datos de publicacion
     //     $post = new Post;
     //     $post->titulo = $request->titulo;
     //     $post->descripcion = $request->descripcion;
     //     $post->imagen = $request->imagen;
     //     $post->user_id = auth()->user()->id;

        //Otra forma de almacenar datos de publicacion
     //   $request->user()->posts()->create([
     //       'titulo' => $request->titulo,
     //       'descripcion' => $request->descripcion,
     //       'imagen' => $request->imagen,
     //       'user_id' => auth()->user()->id
     //   ]);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post) 
    {
        $this->authorize('delete', $post);
         $post->delete();

         //Eliminar Imagen
         $imagen_path = public_path('uploads/' . $post->imagen);

         if(File::exists($imagen_path)) {
            unlink($imagen_path);
         };

         return redirect()->route('posts.index', auth()->user()->username);
    }
}
