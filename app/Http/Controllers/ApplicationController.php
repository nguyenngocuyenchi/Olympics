<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Sport;
use App\Models\Spectateur;
use App\Models\Competition;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
        
    public function gerer(){
        $sports = Sport::all();
        return view('/application/gerer', compact('sports'));
    }


    public function modifier($id) {
        $sports = Sport::all();
        $lieux = Lieu::orderBy('nom')->get();
        $competition = Competition::findOrFail($id);
        return view('/application/modifier', compact('competition','sports','lieux'));
    }

    public function editer(Request $request, $id){
        $sports = Sport::all();
        $lieux = Lieu::orderBy('nom')->get();
        $competition = Competition::findOrFail($id);
    
        $request->validate([
            'sport' => 'required',
            'jour' => 'required',
            'heure_de_debut' => 'required',
            'heure_de_fin' => 'required|after:heure_de_debut',
            'lieu' => 'required',
            'prix' => 'required',
        ]);
    
        $competition->sport_id = $request->input('sport');
        $competition->jour = $request->input('jour');
        $competition->heure_de_debut = $request->input('heure_de_debut');
        $competition->heure_de_fin = $request->input('heure_de_fin');
        $competition->lieu_id = $request->input('lieu');
        $competition->prix = $request->input('prix');
        $competition->save();
        
        // Passer les variables sports et lieux à la vue lors de la redirection
        return redirect()->route('/application/gerer')->with('success', 'La compétition a été modifiée avec succès !')->with('sports', $sports)->with('lieux', $lieux);
    }
    
    
    public function supprimer($id){
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->route('/application/gerer')->with('success', 'La compétition a été supprimée avec succès !');
    }
    

    public function programmer()
    {
        $lieux = Lieu::orderBy('nom')->get();
        $sports = Sport::all();
        return view('/application/programmer', compact('lieux', 'sports'));
    }

    public function sauvegarder(Request $request)
    {
        $request->validate([
            'sport' => 'required',
            'jour' => 'required',
            'heure_de_debut' => 'required',
            'heure_de_fin' => 'required|after:heure_de_debut',
            'lieu' => 'required',
            'prix' => 'required',
        ]);

        $competition = new Competition();
        $competition->jour = $request->jour;
        $competition->heure_de_debut = $request->heure_de_debut;
        $competition->heure_de_fin = $request->heure_de_fin;
        $competition->prix = $request->prix;
        $competition->type = $request->type;
        $competition->lieu_id = $request->lieu;
        $competition->sport_id = $request->sport;
        $competition->save();

        return redirect()->route('/application/programmer')->with('success', 'La compétition a été programmée avec succès !');
    }

}
