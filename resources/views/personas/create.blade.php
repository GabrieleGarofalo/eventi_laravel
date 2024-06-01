@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-8">Registrazione alla Partecipazione dell'Evento</h1>
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Errore:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>>
        </div>
    @endif
    <form action="{{ route('personas.store') }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="evento_id" class="block text-gray-700 font-semibold mb-2">ID Evento:</label>
            <input type="text" name="evento_id" id="evento_id" value="{{ request()->query('evento') }}" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" readonly required>
        </div>
        <div class="mb-4">
            <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome:</label>
            <input type="text" name="nome" id="nome" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="cognome" class="block text-gray-700 font-semibold mb-2">Cognome:</label>
            <input type="text" name="cognome" id="cognome" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrati</button>
    </form>
</div>
@endsection
