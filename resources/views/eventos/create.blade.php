
@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Crea Nuovo Evento</h1>
        <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome:</label>
                <input type="text" name="nome" id="nome" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="data" class="block text-gray-700 font-semibold mb-2">Data:</label>
                <input type="date" name="data" id="data" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="immagine" class="block text-gray-700 font-semibold mb-2">Immagine:</label>
                <input type="file" name="immagine" id="immagine" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="descrizione" class="block text-gray-700 font-semibold mb-2">Descrizione:</label>
                <textarea name="descrizione" id="descrizione" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Crea Evento</button>
        </form>
    </div>
@endsection
