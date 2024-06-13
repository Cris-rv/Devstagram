@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')

    <x-Listar-Post :posts="$posts" />

@endsection
