@extends('layouts.default')

@section('title', 'SR33')

@section('description', $metadatos->description ?? "")
@section('keywords', $metadatos->keywords ?? "")

@section('content')
    <x-slider :sliders="$sliders" />
    <x-search-bar :categorias="$categorias" :marcas="$marcas" :modelos="$modelos" />
    <x-productos-destacados :productos="$productos" />
    <x-banner-portada :bannerPortada="$bannerPortada" />
    <x-novedades-inicio :novedades="$novedades" />
@endsection