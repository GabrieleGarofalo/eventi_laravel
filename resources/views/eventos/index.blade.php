

@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Eventi</h1>
        <a href="{{ route('eventos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg mb-4 inline-block">Crea nuovo evento</a>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($eventos as $evento)
                <div class="bg-white shadow-md rounded-lg p-4">
                    @if ($evento->immagine)
                        <img src="{{ asset('storage/' . $evento->immagine) }}" alt="{{ $evento->nome }}" class="w-full h-32 object-cover rounded-t-lg">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Placeholder Image" class="w-full h-32 object-cover rounded-t-lg">
                    @endif
                    <h2 class="text-lg font-semibold mt-2">{{ $evento->nome }} - {{ $evento->data }}</h2>
                    <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($evento->descrizione, 100) }}</p>
                    <a href="{{ route('eventos.show', $evento->id) }}" class="text-blue-500 mt-4 inline-block">Read More</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
