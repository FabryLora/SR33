@extends('layouts.default')
@section('title', 'Productos - SR33')

@section('description', $metadatos->description ?? "")
@section('keywords', $metadatos->keywords ?? "")

@section('content')
    <div class="flex flex-col gap-10 max-sm:gap-6">



        <x-search-bar :categorias="$categorias" :marcas="$marcas" :modelos="$modelos" :tipo="$tipo" :code="$code"
            :codesr="$code_sr" :marca="$marca" :modelo="$modelo" />

        <!-- Main content with sidebar and products -->
        <div class="flex flex-col lg:flex-row gap-6 max-sm:gap-4 w-[1200px] max-sm:w-full max-sm:px-4 mx-auto">

            {{-- Sidebar with categories --}}


            <div class="w-full mb-10">
                <div class="grid grid-cols-1 md:grid-cols-4 max-sm:grid-cols-1 gap-6 max-sm:gap-4">
                    @forelse($productos as $producto)
                        <a href="{{ "/p/" . $producto->code_sr }}"
                            class=" transition transform hover:-translate-y-1 hover:shadow-lg duration-300
                                                                                                                                                                                                                        h-[420px]  flex flex-col w-[288px] max-sm:w-full rounded-sm border border-[#DEDFE0]">
                            <div class="h-full flex flex-col">
                                @if ($producto->imagenes->count() > 0)
                                    <div class="relative min-h-[287px] max-sm:h-[200px]">
                                        <img src="{{ $producto->imagenes->first()->image }}" alt="{{ $producto->name }}"
                                            class=" w-full h-full  object-contain rounded-t-sm">
                                        <h2
                                            class="absolute left-3 bottom-2 text-[14px] font-semibold uppercase text-primary-orange">
                                            {{$producto->categoria->name ?? ''}}
                                        </h2>
                                    </div>

                                @else
                                    <div class="relative min-h-[287px] max-sm:h-[200px]">
                                        <img src={{$logos->logo_principal}} alt="{{ $producto->name }}"
                                            class=" w-full h-full  object-contain rounded-t-sm">
                                        <h2
                                            class="absolute left-3 bottom-2 text-[14px] font-semibold uppercase text-primary-orange">
                                            {{$producto->categoria->name ?? ''}}
                                        </h2>
                                    </div>
                                @endif
                                <div class="h-1 bg-[#DEDFE0] mx-3"></div>
                                <div class="flex flex-col justify-start gap-2 my-2 h-full max-sm:p-3 px-3">
                                    <div class="flex flex-row justify-between">
                                        @if ($producto->code)

                                            <h3
                                                class="text-black group-hover:text-green-700 text-[16px] max-sm:text-[14px] transition-colors duration-300">
                                                Cod. Or.: {{ Str::limit($producto->code, 10, '...') }}
                                            </h3>
                                        @endif
                                        <h3
                                            class="text-primary-orange group-hover:text-green-700 text-[16px] max-sm:text-[14px] transition-colors duration-300">
                                            Cod.: {{ $producto->code_sr }}
                                        </h3>
                                    </div>
                                    <p
                                        class="text-gray-800 text-[18px] max-sm:text-[14px] font-semibold transition-colors duration-300 line-clamp-3 overflow-hidden">
                                        {{ $producto->name }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-3 max-sm:col-span-1 py-8 max-sm:py-6 text-center text-gray-500">
                            No hay productos disponibles en esta categoría.
                        </div>
                    @endforelse
                </div>

                {{-- Enlaces de paginación --}}
                @if($productos->hasPages())
                    <div class="mt-8 max-sm:mt-6 flex flex-col justify-center my-10">
                        <div class="pagination-wrapper">
                            {{ $productos->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection