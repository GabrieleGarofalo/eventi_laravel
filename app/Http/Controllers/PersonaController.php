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

        $persona = new Persona();
        $persona->nome = $request->input('nome');
        $persona->cognome = $request->input('cognome');
        $persona->evento_id = $request->input('evento_id'); // Assicurati di includere l'ID dell'evento qui
        $persona->save();

        return redirect()->route('eventos.index')->with('success', 'Persona creata con successo.');
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
