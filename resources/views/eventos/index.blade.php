@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-8">Eventi</h1>
        <a href="{{ route('eventos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-8 inline-block hover:bg-blue-600 transition duration-300 ease-in-out">Crea nuovo evento</a>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($eventos as $evento)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="relative overflow-hidden rounded-t-lg">
                        @if ($evento->immagine)
                            <img src="{{ asset('storage/' . $evento->immagine) }}" alt="{{ $evento->nome }}" class="w-full h-48 object-cover rounded-t-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200"></div>
                        @endif
                        <div class="absolute top-0 right-0 bg-blue-500 text-white px-3 py-1 rounded-tr-lg">{{ $evento->data }}</div>
                    </div>
                    <h2 class="text-lg font-semibold mt-4">{{ $evento->nome }}</h2>
                    <p class="text-gray-600 mt-2 leading-snug">{{ \Illuminate\Support\Str::limit($evento->descrizione, 100) }}</p>
                    <a href="{{ route('eventos.show', $evento->id) }}" class="text-blue-500 mt-4 inline-block">Leggi di più</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
