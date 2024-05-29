@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-semibold mb-4">{{ $evento->nome }}</h1>
        <p class="text-gray-700 mb-2">Data: {{ $evento->data }}</p>
        <p class="text-gray-700 mb-2">Descrizione: {{ $evento->descrizione }}</p> <!-- Aggiungi questo -->

        <h2 class="text-xl font-semibold mb-2">Partecipanti:</h2>
        @if($evento->personas && $evento->personas->count() > 0)
            <ul>
                @foreach ($evento->personas as $persona)
                    <li class="text-blue-500">{{ $persona->nome }} {{ $persona->cognome }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Nessun partecipante registrato.</p>
        @endif
        <div class="mt-6">
            <a href="{{ route('eventos.edit', $evento->id) }}" class="text-blue-500 font-semibold mr-4 hover:underline">Modifica</a>
            <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 font-semibold hover:underline">Elimina</button>
            </form>
            <a href="{{ route('personas.create', ['evento' => $evento->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Registrati</a>
        </div>
    </div>
</div>
@endsection
