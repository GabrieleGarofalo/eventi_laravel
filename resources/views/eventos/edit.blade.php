@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Modifica evento</h1>
    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $evento->nome) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="data" class="block text-gray-700 text-sm font-bold mb-2">Data:</label>
            <input type="date" name="data" id="data" value="{{ old('data', $evento->data) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="immagine" class="block text-gray-700 font-semibold mb-2">Immagine:</label>
            <input type="file" name="immagine" id="immagine" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
            @if ($evento->immagine)
                <img src="{{ asset('storage/' . $evento->immagine) }}" alt="{{ $evento->nome }}" class="mt-4 w-full h-32 object-cover">
            @endif
        </div>

        <div class="mb-4">
            <label for="descrizione" class="block text-gray-700 font-semibold mb-2">Descrizione:</label>
            <textarea name="descrizione" id="descrizione" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">{{ $evento->descrizione }}</textarea>
        </div>

        <h2 class="text-xl font-bold mb-2">Partecipanti:</h2>
        @if($evento->personas && $evento->personas->count() > 0)
            <ul class="mb-4">
                @foreach ($evento->personas as $persona)
                    <li class="mb-2">{{ $persona->nome }} {{ $persona->cognome }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-700 mb-4">Nessun partecipante registrato.</p>
        @endif

        <h2 class="text-xl font-bold mb-2">Aggiungi partecipante:</h2>
        <div class="mb-4">
            <label for="persona_nome" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
            <input type="text" name="persona_nome" id="persona_nome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="persona_cognome" class="block text-gray-700 text-sm font-bold mb-2">Cognome:</label>
            <input type="text" name="persona_cognome" id="persona_cognome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Aggiorna Evento</button>
        </div>
    </form>

    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Elimina Evento</button>
    </form>
</div>
@endsection
