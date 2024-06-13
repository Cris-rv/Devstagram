@extends('layouts.app')

@section('titulo')
    Inicia Sesion en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-4 md:items-center">
        <div class="md:w-7/12 p-5 shadow-xl border rounded-xl">
           <img src="{{ asset('img/login.jpg') }}" alt="Imagen login usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                @if(@session('mensaje'))
                    <p class="bg-red-500 text-white my-2 block rounded-lg text-sm p-2 text-center">
                    {{ session('mensaje') }}
                 </p>
                @endif

                <div class="mb-5">
                </div>
                <div>
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                            Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 block rounded-lg text-sm p-2 text-center">
                    {{$message}} </p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                            Password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg  @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 block rounded-lg text-sm p-2 text-center">
                    {{$message}} </p>
                    @enderror

                    <div class="mb-5">
                        <input type="checkbox" name="remember"> <label class="text-sm  text-gray-500">Mantener mi sesion abierta</label>
                    </div>

                <input 
                type="submit"
                value="Iniciar Sesion"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>

    </div>
    
@endsection