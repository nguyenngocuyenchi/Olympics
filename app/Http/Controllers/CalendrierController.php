<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Sport;
use App\Models\Spectateur;
use App\Models\Competition;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{
    public function afficherCalendrierQuotidien(Request $request)
    {
        $jours_olympique = [
            "2024-07-24", "2024-07-25", "2024-07-26", "2024-07-27", "2024-07-28", "2024-07-29",
            "2024-07-30", "2024-07-31", "2024-08-01", "2024-08-02", "2024-08-03", "2024-08-04", 
            "2024-08-05", "2024-08-06", "2024-08-07", "2024-08-08", "2024-08-09", "2024-08-10", "2024-08-11"
        ];
    
        $sports = Sport::all();
        $lieux = Lieu::orderBy('nom')->get();
        $query = Competition::query();
        
        if ($request->has('lieu_filter')) {
            $query->where('lieu_id', $request->input('lieu_filter'));
        } 
        if ($request->has('date_filter')) {
            $query->where('jour', $request->input('date_filter'));
        }
    
        $competitions = $query->get();
        return view('/calendrier/calendrier_quotidien', compact('competitions', 'sports', 'lieux', 'jours_olympique'));
    }
    
    public function afficherCalendrierMensuel()
    {
        $jours_olympique = [
            "2024-07-24", "2024-07-25", "2024-07-26", "2024-07-27", "2024-07-28", "2024-07-29",
            "2024-07-30", "2024-07-31", "2024-08-01", "2024-08-02", "2024-08-03", "2024-08-04", 
            "2024-08-05", "2024-08-06", "2024-08-07", "2024-08-08", "2024-08-09", "2024-08-10", "2024-08-11"
        ];
        $sports = Sport::all(); 
        return view('/calendrier/calendrier_mensuel', compact('sports', 'jours_olympique'));
    }

}
