@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-semibold mb-4">{{ $evento->nome }}</h1>
        <p class="text-gray-700 mb-2">Data: {{ $evento->data }}</p>
        <p class="text-gray-700 mb-2">Descrizione: {{ $evento->descrizione }}</p>

        <h2 class="text-xl font-semibold mb-2">Partecipanti ({{ $evento->personas->count() }}):</h2>
        @if($evento->personas && $evento->personas->count() > 0)
            <ul class="mb-4 bg-gray-100 p-4 rounded-lg">
                @foreach ($evento->personas as $persona)
                    <li class="flex justify-between items-center mb-2">
                        <span>{{ $persona->nome }} {{ $persona->cognome }}</span>
                    </li>
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
            @if($evento->personas->count() < 10)
                <a href="{{ route('personas.create', ['evento' => $evento->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Registrati</a>
            @else
                <p class="text-red-500 font-semibold mt-2">Limite massimo di partecipanti raggiunto. Contattare l'organizzatore.</p>
            @endif
        </div>
    </div>
</div>
@endsection
