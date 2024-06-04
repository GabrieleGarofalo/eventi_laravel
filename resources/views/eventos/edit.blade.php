@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-4">Modifica Evento</h1>

    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-8" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 text-sm font-semibold mb-2">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $evento->nome) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="data" class="block text-gray-700 text-sm font-semibold mb-2">Data:</label>
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

        <h2 class="text-xl font-semibold mb-2">Partecipanti (<span id="participant-count">{{ $evento->personas->count() }}</span>):</h2>
        @if($evento->personas && $evento->personas->count() > 0)
        <ul id="participants-list">
            @foreach ($evento->personas as $persona)
                <li class="flex justify-between items-center mb-2" id="persona-{{ $persona->id }}">
                    <span>{{ $persona->nome }} {{ $persona->cognome }}</span>
                    <form action="{{ route('personas.destroy', $persona->id) }}" method="POST" class="inline delete-persona-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-2 rounded focus:outline-none focus:shadow-outline delete-persona" data-persona-id="{{ $persona->id }}">Elimina</button>
                    </form>
                </li>
            @endforeach
        </ul>

        @else
            <p class="text-gray-700 mb-4">Nessun partecipante registrato.</p>
        @endif

        @if($evento->personas->count() < 10)
            <h2 class="text-xl font-semibold mb-2">Aggiungi partecipante:</h2>

            @include('components.register-participant-form', ['eventoId' => $evento->id])
            @else

            <p class="text-red-500 font-semibold">Limite massimo di partecipanti raggiunto. Contattare l'organizzatore.</p>
        @endif

        <div class="flex items-center justify-between mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Aggiorna Evento</button>
            <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Elimina Evento</button>
            </form>
        </div>
    </form>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-persona');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const personaId = this.getAttribute('data-persona-id');
            const url = this.closest('form').action;

            if (confirm('Sei sicuro di voler eliminare questa persona?')) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        document.getElementById('persona-' + personaId).remove();
                        updateParticipantCount();
                        alert('Persona eliminata con successo.');
                    } else {
                        alert('Errore durante l\'eliminazione della persona.');
                    }
                });
            }
        });
    });

    function updateParticipantCount() {
        const participantCountElement = document.getElementById('participant-count');
        const currentCount = parseInt(participantCountElement.textContent, 10);
        participantCountElement.textContent = currentCount - 1;
    }
});
</script>

@endsection
