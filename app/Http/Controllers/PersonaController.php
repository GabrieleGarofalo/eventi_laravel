<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Evento;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        $eventos = Evento::all();
        return view('personas.create', compact('eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'evento_id' => 'required|exists:eventos,id',
        ]);

        // Trova l'evento
        $evento = Evento::find($request->input('evento_id'));
        $evento_id = $request->input('evento_id');

        // Verifica se il numero di partecipanti è inferiore a 10
        if ($evento->personas->count() < 10) {
            // Controlla se l'utente è già registrato per l'evento attuale
            $existingPersonaThisEvent = Persona::where('nome', $request->input('nome'))
                                               ->where('cognome', $request->input('cognome'))
                                               ->where('evento_id', $evento_id)
                                               ->first();

            // Controlla se l'utente è già registrato per un altro evento
            $existingPersonaOtherEvent = Persona::where('nome', $request->input('nome'))
                                                ->where('cognome', $request->input('cognome'))
                                                ->where('evento_id', '!=', $evento_id)
                                                ->first();

            if ($existingPersonaThisEvent) {
                // Se l'utente è già registrato per l'evento attuale, mostra un messaggio di errore
                return redirect()->back()->with('error', 'Sei già registrato per questo evento.');
            } elseif ($existingPersonaOtherEvent) {
                // Se l'utente è già registrato per un altro evento, mostra un messaggio di errore
                return redirect()->back()->with('error', 'Sei già registrato per un altro evento.');
            }

            // Se il limite non è stato raggiunto e l'utente non è già registrato per nessun evento, crea un nuovo partecipante
            $persona = new Persona();
            $persona->nome = $request->input('nome');
            $persona->cognome = $request->input('cognome');
            $persona->evento_id = $evento_id;
            $persona->save();

            // Se il form è stato inviato dalla pagina di modifica, aggiorna il contatore dei partecipanti
            if ($request->has('from_edit_page')) {
                return redirect()->back()->with('success', 'Persona creata con successo.');
            } else {
                return redirect()->route('eventos.index')->with('success', 'Persona creata con successo.');
            }
        } else {
            // Se il limite è stato raggiunto, mostra un messaggio di errore e reindirizza alla pagina di creazione
            return redirect()->route('eventos.index')->with('error', 'Limite massimo di partecipanti raggiunto. Contattare l\'organizzatore.');
        }
    }





    public function show(Persona $persona)
    {
        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        $eventos = Evento::all();
        return view('personas.edit', compact('persona', 'eventos'));
    }

    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'evento_id' => 'nullable|exists:eventos,id',
        ]);

        $persona->update($request->all());
        return redirect()->route('personas.index')->with('success', 'Persona aggiornata con successo.');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();
        return redirect()->back()->with('success', 'Persona eliminata con successo.');
    }

}
