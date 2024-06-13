@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form method="POST" class="mt-10 md:mt-0" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                            Username
                    </label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 block rounded-lg text-sm p-2 text-center">
                        {{$message}} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                            Imagen perfil
                    </label>
                    <input 
                        id="imagen"
                        name="imagen"
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        accept=".jpg, .jpeg, .png"
                    />
                </div>


                <input 
                type="submit"
                value="Guardar cambios"
                class="bg-green-500 hover:bg-green-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection