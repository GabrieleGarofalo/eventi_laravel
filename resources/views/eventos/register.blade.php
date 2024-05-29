@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Registrazione partecipazione evento</h1>
        <form action="" method="">
            @csrf
            <div class="mb-4">
                <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome:</label>
                <input type="text" name="nome" id="nome" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="cognome" class="block text-gray-700 font-semibold mb-2">Cognome:</label>
                <input type="text" name="cognome" id="cognome" class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:border-blue-500" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Registrati</button>
        </form>
    </div>
@endsection
