@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="p-3 flex items-center gap-4">

            <form method="POST" action="{{ route('whatsapp') }}">
                @csrf
            <div class="my-4">
            <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
            </svg>
            </button>
            </div>
            </form>


            @auth
            <livewire:like-post :post="$post" />

{{--         
            @if( $post->checkLike( auth()->user() ))
            <form method="POST" action="{{ route('posts.likes.destroy',$post) }}">
                @method('DELETE')
                @csrf
            <div class="my-4">
            <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            </button>
            </div>
            </form>
            @else
            <form method="POST" action="{{ route('posts.likes.store',$post) }}">
                @csrf
            <div class="my-4">
            <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            </button>
            </div>
            </form>
            @endif --}}

            @endauth

            
            </div>

            <div>
                <p class="font-bold"> {{ $post->user->username }} </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans()}}
                </p>
                <p class="mt-5">
                    {{$post->descripcion}}
                </p>
            </div>

            @auth
                @if($post->user_id == auth()->user()->id)
            <form method="POST" action="{{ route('posts.destroy',$post) }}">
                @method('DELETE')
                @csrf
                <input
                type="submit"
                value="Eliminar publicación"
                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer">
            </form>
               @endif
           @endauth

        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth
                <p class="text-xl font-bold text-center mb-4">Agregar un Nuevo Comentario</p>

                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif

                <form action="{{ route('comentarios.store',['user'=>$user,'post'=>$post]) }}" method="POST">
                @csrf
                <div class="mb-5"> 
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Añade un comentario
                    </label>

                    <textarea 
                    id="comentario"
                    name="comentario"
                    placeholder="Agrega un comentario"
                    class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
                    ></textarea>
                </div> 

                <input 
                type="submit"
                value="Comentar"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />

                </form>

                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if($post->comentarios->count())
                        @foreach($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                {{$comentario->user->username}}
                            </a>
                            <p>{{$comentario->comentario}}</p>
                            <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                        </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios Aún</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection