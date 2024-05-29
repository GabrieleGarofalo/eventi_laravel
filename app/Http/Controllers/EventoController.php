<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Persona;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::all();
        return view('eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'data' => 'required|date',
            'descrizione' => 'required',
            'immagine' => 'nullable|image|max:2048', // Valida l'immagine
        ]);

        $evento = new Evento();
        $evento->nome = $request->input('nome');
        $evento->data = $request->input('data');
        $evento->descrizione = $request->descrizione;

        if ($request->hasFile('immagine')) {
            $evento->immagine = $request->file('immagine')->store('immagini', 'public');
        }

        $evento->save();

        return redirect()->route('eventos.index')->with('success', 'Evento creato con successo.');
    }


    public function show(Evento $evento)
    {
        $evento = Evento::with('personas')->find($evento->id);
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nome' => 'required',
            'data' => 'required|date',
            'descrizione' => 'required',
            'immagine' => 'nullable|image|max:2048', // Valida l'immagine
        ]);

        $evento->nome = $request->input('nome');
        $evento->data = $request->input('data');
        $evento->descrizione = $request->descrizione;


        if ($request->hasFile('immagine')) {
            // Elimina l'immagine precedente se esiste
            if ($evento->immagine) {
                Storage::disk('public')->delete($evento->immagine);
            }

            $evento->immagine = $request->file('immagine')->store('immagini', 'public');
        }

        $evento->save();


        return redirect()->route('eventos.show', $evento->id)->with('success', 'Evento aggiornato con successo.');
    }

    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.index')->with('success', 'Evento eliminato con successo.');
    }

    // Mostra il form di registrazione per un evento
    public function RegisterForm(Evento $evento)
    {
        return view('eventos.register', compact('evento'));
    }

    // Registra un partecipante per un evento
    public function register(Request $request, Evento $evento)
    {
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
        ]);

        $persona = new Persona([
            'nome' => $request->input('nome'),
            'cognome' => $request->input('cognome'),
        ]);
        $evento->personas()->save($persona);

        return redirect()->route('eventos.show', $evento->id)->with('success', 'Partecipante registrato con successo.');
    }

    // Rimuovi un partecipante da un evento
    public function removeParticipant(Evento $evento, Persona $persona)
    {
        $persona->delete();
        return redirect()->back()->with('success', 'Partecipante rimosso con successo.');
    }
}
