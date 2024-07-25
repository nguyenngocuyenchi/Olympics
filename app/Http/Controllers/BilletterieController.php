<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Sport;
use App\Models\Spectateur;
use App\Models\Competition;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BilletterieController extends Controller
{
    

    function affiche_sports_sport() {
        $sports = Sport::all();
        return view('/billetterie/sport', compact('sports'));
    }
  

    function affiche_sports_billetterie() {
        $sports = Sport::all();
        return view('billetterie', compact('sports'));
    }

    function affiche_competitions_billetterie() {
        $sports = Sport::with('competitions')->get();
        return view('billetterie', compact('sports'));
    } 


    public function billetterie(){
        $sports = Sport::all();
        $spectateurs = Spectateur::all();

        return view('billetterie.billetterie', compact('sports', 'spectateurs'));
    }
    
    
    public function recapitulatif(Request $request) {
        $request->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'telephone' =>'required',
            'email' => 'required'
        ]);
    
        $sports = Sport::all(); 
    
        $spectateur = Spectateur::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);
    
        $total_billets = $request->input('total_billets');
        $spectateurs = Spectateur::all();


        foreach ($request->total_billets as $competitionId) {
            Reservation::create([
                'spectateur_id' => $spectateur->id,
                'competition_id' => $competitionId,
            ]);
        }
        $reservation->save();

    
        return view('/billetterie/recapitulatif')
            ->with('success', 'Merci pour votre réservation !')
            ->with('spectateur', $spectateur)
            ->with('spectateurs', $spectateurs)
            ->with('sports', $sports)
            ->with('total_billets', $total_billets);
    }

    public function panier(Request $request) {
        return view('billetterie.panier');
    }
    
}
