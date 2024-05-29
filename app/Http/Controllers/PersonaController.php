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
            'evento_id' => 'required|exists:eventos,id', // Assicurati che l'ID dell'evento sia richiesto e valido
        ]);

        // Trova l'evento
        $evento = Evento::find($request->input('evento_id'));

        // Verifica se il numero di partecipanti è inferiore a 10
        if ($evento->personas->count() < 10) {
            // Se il limite non è stato raggiunto, crea un nuovo partecipante
            $persona = new Persona();
            $persona->nome = $request->input('nome');
            $persona->cognome = $request->input('cognome');
            $persona->evento_id = $request->input('evento_id');
            $persona->save();

            return redirect()->route('eventos.index')->with('success', 'Persona creata con successo.');
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
        return redirect()->route('personas.index')->with('success', 'Persona eliminata con successo.');
    }
}
