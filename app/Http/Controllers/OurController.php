<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Sport;
use App\Models\Spectateur;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OurController extends Controller
{

    ///PROGRAMMER UNE COMPETITION///
    
    public function gerer(){
        $sports = Sport::all();
        return view('/application/gerer', compact('sports'));
    }


    public function modifier($id) {
        $competition = Competition::findOrFail($id);
        return view('/application/modifier', compact('competition'));
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

        return redirect()->route('programmer')->with('success', 'La compétition a été programmée avec succès !');
    }

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

    public function showSpectateurs()
    {
        $spectateurs = Spectateur::all();
        return view('liste_spectateurs', compact('spectateurs')); 
    }

    public function showCompetitions()
    {
        $sports = Competition::with('sport')->get(); 
        $competitions = Competition::with('lieu')->get(); 
        return view('liste_competitions', compact('sports', 'competitions')); 
    }

    public function showLieux()
    {
        $lieus = Lieu::all();
        return view('liste_lieux', compact('lieus'));
   }

   
   public function showSports()
    {
        $sports = Sport::all();
        return view('liste_sports', compact('sports'));
    } 


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
        $sports=Sport::all();
        return view('billetterie.billetterie', compact('sports'));
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
    
        return view('/billetterie/recapitulatif')
            ->with('success', 'Merci pour votre réservation !')
            ->with('spectateur', $spectateur)
            ->with('sports', $sports)
            ->with('total_billets', $total_billets);
    }
    

    
    public function enregistrer_lieux(){

// LIEUX (35)

// LIEUX SUR PARIS
    Lieu::create(['nom' => 'Arena Porte de la Chapelle', 'capacite' => 7000]);
    Lieu::create(['nom' => 'Arena Bercy', 'capacite' => 15000]);    
    Lieu::create(['nom' => 'Parc Urbain La Concorde', 'capacite' => 25000]);
    Lieu::create(['nom' => 'Pont Alexandre III', 'capacite' => 1000]);
    Lieu::create(['nom' => 'Parc des Princes', 'capacite' => 47926]);
    Lieu::create(['nom' => 'Grand Palais', 'capacite' => 8000]);
    Lieu::create(['nom' => 'Hôtel de Ville', 'capacite' => NULL]);
    Lieu::create(['nom' => 'Invalides', 'capacite' => 8000]);
    Lieu::create(['nom' => 'Trocadéro', 'capacite' => 3349]);
    Lieu::create(['nom' => 'Arena Champ de Mars', 'capacite' => 8356]);
    Lieu::create(['nom' => 'Stade Tour Eiffel', 'capacite' => 12860]);
    Lieu::create(['nom' => 'Stade Roland Garros', 'capacite' => 14962]);
    Lieu::create(['nom' => 'Arena Paris Sud', 'capacite' => 6650]);

// LIEUX EN ILE DE FRANCE
    Lieu::create(['nom' => 'Site d\'Escalade du Bourget', 'capacite' => 6000]);
    Lieu::create(['nom' => 'Arena Paris Nord', 'capacite' => 6000]);
    Lieu::create(['nom' => 'Stade de France', 'capacite' => 77083]);
    Lieu::create(['nom' => 'Centre Aquatique', 'capacite' => 5000]);
    Lieu::create(['nom' => 'Stade Yves-du-Manoir', 'capacite' => 15000]);
    Lieu::create(['nom' => 'Paris La Défense Arena à Nanterre', 'capacite' => 17000]);
    Lieu::create(['nom' => 'Château de Versailles', 'capacite' => 40000]);
    Lieu::create(['nom' => 'Vélodrome National de Saint-Quentin-en-Yvelines', 'capacite' => 5000]);
    Lieu::create(['nom' => 'Stade BMX de Saint-Quentin-en-Yvelines', 'capacite' => 3000]);
    Lieu::create(['nom' => 'Golf National', 'capacite' => 32720]);
    Lieu::create(['nom' => 'Colline d\'Elancourt', 'capacite' => 15000]);
    Lieu::create(['nom' => 'Stade nautique de Vaires-sur-Marne', 'capacite' => 24000]);

// LIEUX PARTOUT EN FRANCE
    Lieu::create(['nom' => 'Stade Pierre Mauroy', 'capacite' => 27000]);
    Lieu::create(['nom' => 'Stade de la Beaujoire', 'capacite' => 37473]);
    Lieu::create(['nom' => 'Centre National de Tir de Châteauroux', 'capacite' => 3500]);
    Lieu::create(['nom' => 'Stade de Lyon', 'capacite' => 59186]);
    Lieu::create(['nom' => 'Stade Geoffroy-Guichard', 'capacite' => 41965]);
    Lieu::create(['nom' => 'Stade de Bordeaux', 'capacite' => 42000]);
    Lieu::create(['nom' => 'Stade de Marseille', 'capacite' => 67394]);
    Lieu::create(['nom' => 'Stade de Nice', 'capacite' => 36178]);
    Lieu::create(['nom' => 'Marina de Marseille', 'capacite' => 12262]);

// LIEUX HORS DE LA FRANCE
    Lieu::create(['nom' => 'Teahupo\'o, Tahiti', 'capacite' => NULL]);

    return "Les lieux ont été enregistrés avec succès.";
}


// SPORTS (45)
public function enregistrer_sports () {
    Sport::create(['nom' => 'Athlétisme']);
    Sport::create(['nom' => 'Aviron']);
    Sport::create(['nom' => 'Badminton']);
    Sport::create(['nom' => 'Basketball']);
    Sport::create(['nom' => 'Basketball 3×3']);
    Sport::create(['nom' => 'BMX freestyle']);
    Sport::create(['nom' => 'BMX racing']);
    Sport::create(['nom' => 'Boxe']);
    Sport::create(['nom' => 'Breaking']);
    Sport::create(['nom' => 'Canoë sprint']);
    Sport::create(['nom' => 'Canoë-kayak slalom']);
    Sport::create(['nom' => 'Cyclisme sur piste']);
    Sport::create(['nom' => 'Cyclisme sur route']);
    Sport::create(['nom' => 'Escalade sportive']);
    Sport::create(['nom' => 'Escrime']);
    Sport::create(['nom' => 'Football']);
    Sport::create(['nom' => 'Golf']);
    Sport::create(['nom' => 'Gymnastique artistique']);
    Sport::create(['nom' => 'Gymnastique rythmique']);
    Sport::create(['nom' => 'Haltérophilie']);
    Sport::create(['nom' => 'Handball']);
    Sport::create(['nom' => 'Hockey']);
    Sport::create(['nom' => 'Judo']);
    Sport::create(['nom' => 'Lutte']); 
    Sport::create(['nom' => 'Mountain bike (VTT)']);   
    Sport::create(['nom' => 'Natation']);
    Sport::create(['nom' => 'Natation artistique']);
    Sport::create(['nom' => 'Natation marathon']);
    Sport::create(['nom' => 'Pentathlon moderne']);
    Sport::create(['nom' => 'Plongeon']);
    Sport::create(['nom' => 'Rugby']);
    Sport::create(['nom' => 'Skateboard']);
    Sport::create(['nom' => 'Sports équestres']);
    Sport::create(['nom' => 'Surf']);
    Sport::create(['nom' => 'Taekwondo']);
    Sport::create(['nom' => 'Tennis']);
    Sport::create(['nom' => 'Tennis de table']);
    Sport::create(['nom' => 'Tir']);
    Sport::create(['nom' => 'Tir à l\'arc']);
    Sport::create(['nom' => 'Trampoline']);
    Sport::create(['nom' => 'Triathlon']);
    Sport::create(['nom' => 'Voile']);
    Sport::create(['nom' => 'Volleyball']);
    Sport::create(['nom' => 'Volleyball de plage']);
    Sport::create(['nom' => 'Waterpolo']);
    
    return "Les sports ont été enregistrés avec succès.";

}


public function enregistrer_competitions(){

// COMPETITIONS (45*3)

// ATHLETISME
Competition::create([
    'jour' => '2024-08-01',
    'heure_de_debut' => '07:30:00',
    'heure_de_fin' => '11:05:00',
    'prix'=>20.00,
    'type' => '1er tour'
])->sport()->associate(Sport::where('nom', 'Athlétisme')->first())
->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();

Competition::create([
    'jour' => '2024-08-05',
    'heure_de_debut' => '18:30:00',
    'heure_de_fin' => '22:00:00',
    'prix' => 30.00,'type'=>'Demi-Finale'
])->sport()->associate(Sport::where('nom', 'Athlétisme')->first())
->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();

Competition::create([
    'jour' => '2024-08-06',
    'heure_de_debut' => '18:30:00',
    'heure_de_fin' => '22:30:00',
    'prix' => 40.00,'type'=>'Finale'
])->sport()->associate(Sport::where('nom', 'Athlétisme')->first())
->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();

// AVIRON
Competition::create(['jour'=>'2024-07-27','heure_de_debut'=>'09:00:00','heure_de_fin'=>'13:10:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Aviron')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();
Competition::create(['jour'=>'2024-07-29','heure_de_debut'=>'09:30:00','heure_de_fin'=>'12:40:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Aviron')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();
Competition::create(['jour'=>'2024-08-03','heure_de_debut'=>'09:30:00','heure_de_fin'=>'11:40:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Aviron')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();

// BADMINTON
Competition::create(['jour' => '2024-07-27', 'heure_de_debut' => '08:00:00', 'heure_de_fin' => '10:30:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Badminton')->first())->lieu()->associate(Lieu::where('nom', 'Arena Porte de la Chapelle')->first())->save();
Competition::create(['jour' => '2024-07-31', 'heure_de_debut' => '11:00:00', 'heure_de_fin' => '14:40:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Badminton')->first())->lieu()->associate(Lieu::where('nom', 'Arena Porte de la Chapelle')->first())->save();
Competition::create(['jour' => '2024-08-05', 'heure_de_debut' => '14:00:00', 'heure_de_fin' => '17:30:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Badminton')->first())->lieu()->associate(Lieu::where('nom', 'Arena Porte de la Chapelle')->first())->save();

// BASKETBALL
Competition::create(['jour' => '2024-07-29', 'heure_de_debut' => '17:15:00', 'heure_de_fin' => '19:00:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Basketball')->first())->lieu()->associate(Lieu::where('nom', 'Stade Pierre Mauroy')->first())->save();
Competition::create(['jour' => '2024-08-07', 'heure_de_debut' => '11:00:00', 'heure_de_fin' => '15:15:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Basketball')->first())->lieu()->associate(Lieu::where('nom', 'Stade Pierre Mauroy')->first())->save();
Competition::create(['jour' => '2024-08-08', 'heure_de_debut' => '21:30:00', 'heure_de_fin' => '00:00:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Basketball')->first())->lieu()->associate(Lieu::where('nom', 'Stade Pierre Mauroy')->first())->save();

// BASKETBALL 3×3
Competition::create(['jour'=>'2024-07-24','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Basketball 3×3')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour'=>'2024-07-26','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Basketball 3×3')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour'=>'2024-08-01','heure_de_debut'=>'15:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Basketball 3×3')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();

// BMX FREESTYLE
Competition::create(['jour'=>'2024-07-24','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'BMX freestyle')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour'=>'2024-07-26','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'BMX freestyle')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'15:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'BMX freestyle')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();

//BMX RACING
Competition::create(['jour'=>'2024-07-24','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'BMX racing')->first())->lieu()->associate(Lieu::where('nom', 'Stade BMX de Saint-Quentin-en-Yvelines')->first())->save();
Competition::create(['jour'=>'2024-07-27','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'BMX racing')->first())->lieu()->associate(Lieu::where('nom', 'Stade BMX de Saint-Quentin-en-Yvelines')->first())->save();
Competition::create(['jour'=>'2024-08-01','heure_de_debut'=>'14:00:00','heure_de_fin'=>'17:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'BMX racing')->first())->lieu()->associate(Lieu::where('nom', 'Stade BMX de Saint-Quentin-en-Yvelines')->first())->save();

// BOXE
Competition::create(['jour' => '2024-08-01', 'heure_de_debut' => '10:00:00', 'heure_de_fin' => '13:15:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Boxe')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Nord')->first())->save();
Competition::create(['jour' => '2024-08-03', 'heure_de_debut' => '18:30:00', 'heure_de_fin' => '22:00:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Boxe')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Nord')->first())->save();
Competition::create(['jour' => '2024-08-06', 'heure_de_debut' => '18:30:00', 'heure_de_fin' => '22:30:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Boxe')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Nord')->first())->save();

// BREAKING
Competition::create(['jour' => '2024-08-01', 'heure_de_debut' => '16:00:00', 'heure_de_fin' => '18:15:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Breaking')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour' => '2024-08-02', 'heure_de_debut' => '20:00:00', 'heure_de_fin' => '22:00:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Breaking')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour' => '2024-08-06', 'heure_de_debut' => '15:30:00', 'heure_de_fin' => '17:45:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Breaking')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();

// CANOE SPRINT
Competition::create(['jour'=>'2024-07-24','heure_de_debut'=>'08:30:00','heure_de_fin'=>'11:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Canoë sprint')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();
Competition::create(['jour'=>'2024-07-28','heure_de_debut'=>'09:00:00','heure_de_fin'=>'12:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Canoë sprint')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Canoë sprint')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();

// CANOE-KAYAK SLALOM
Competition::create(['jour'=>'2024-07-26','heure_de_debut'=>'10:30:00','heure_de_fin'=>'14:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Canoë-kayak slalom')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();
Competition::create(['jour'=>'2024-07-28','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Canoë-kayak slalom')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'09:00:00','heure_de_fin'=>'12:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Canoë-kayak slalom')->first())->lieu()->associate(Lieu::where('nom', 'Stade nautique de Vaires-sur-Marne')->first())->save();

// CYCLISME SUR PISTE
Competition::create(['jour'=>'2024-07-24','heure_de_debut'=>'09:00:00','heure_de_fin'=>'12:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Cyclisme sur piste')->first())->lieu()->associate(Lieu::where('nom', 'Vélodrome National de Saint-Quentin-en-Yvelines')->first())->save();
Competition::create(['jour'=>'2024-07-26','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Cyclisme sur piste')->first())->lieu()->associate(Lieu::where('nom', 'Vélodrome National de Saint-Quentin-en-Yvelines')->first())->save();
Competition::create(['jour'=>'2024-08-09','heure_de_debut'=>'09:30:00','heure_de_fin'=>'13:00:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Cyclisme sur piste')->first())->lieu()->associate(Lieu::where('nom', 'Vélodrome National de Saint-Quentin-en-Yvelines')->first())->save();

// CYCLISME SUR ROUTE
Competition::create(['jour'=>'2024-07-24','heure_de_debut'=>'08:30:00','heure_de_fin'=>'12:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Cyclisme sur route')->first())->lieu()->associate(Lieu::where('nom', 'Pont Alexandre III')->first())->save();
Competition::create(['jour'=>'2024-07-27','heure_de_debut'=>'09:00:00','heure_de_fin'=>'12:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Cyclisme sur route')->first())->lieu()->associate(Lieu::where('nom', 'Trocadéro')->first())->save();
Competition::create(['jour'=>'2024-08-09','heure_de_debut'=>'08:00:00','heure_de_fin'=>'11:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Cyclisme sur route')->first())->lieu()->associate(Lieu::where('nom', 'Trocadéro')->first())->save();

// ESCALADE SPORTIVE
Competition::create(['jour' => '2024-07-25', 'heure_de_debut' => '10:00:00', 'heure_de_fin' => '14:00:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Escalade sportive')->first())->lieu()->associate(Lieu::where('nom', 'Site d\'Escalade du Bourget')->first())->save();
Competition::create(['jour' => '2024-07-29', 'heure_de_debut' => '10:15:00', 'heure_de_fin' => '13:30:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Escalade sportive')->first())->lieu()->associate(Lieu::where('nom', 'Site d\'Escalade du Bourget')->first())->save();
Competition::create(['jour' => '2024-08-05', 'heure_de_debut' => '19:00:00', 'heure_de_fin' => '22:50:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Escalade sportive')->first())->lieu()->associate(Lieu::where('nom', 'Site d\'Escalade du Bourget')->first())->save();

// ESCRIME
Competition::create(['jour' => '2024-07-26', 'heure_de_debut' => '09:30:00', 'heure_de_fin' => '16:50:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Escrime')->first())->lieu()->associate(Lieu::where('nom', 'Grand Palais')->first())->save();
Competition::create(['jour' => '2024-08-01', 'heure_de_debut' => '10:00:00', 'heure_de_fin' => '17:10:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Escrime')->first())->lieu()->associate(Lieu::where('nom', 'Grand Palais')->first())->save();
Competition::create(['jour' => '2024-08-02', 'heure_de_debut' => '19:10:00', 'heure_de_fin' => '22:30:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Escrime')->first())->lieu()->associate(Lieu::where('nom', 'Grand Palais')->first())->save();

// FOOTBALL
Competition::create(['jour' => '2024-07-28', 'heure_de_debut' => '19:00:00', 'heure_de_fin' => '21:00:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Football')->first())->lieu()->associate(Lieu::where('nom', 'Parc des Princes')->first())->save();
Competition::create(['jour' => '2024-08-04', 'heure_de_debut' => '20:00:00', 'heure_de_fin' => '22:00:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Football')->first())->lieu()->associate(Lieu::where('nom', 'Parc des Princes')->first())->save();
Competition::create(['jour' => '2024-08-07', 'heure_de_debut' => '15:00:00', 'heure_de_fin' => '17:00:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Football')->first())->lieu()->associate(Lieu::where('nom', 'Parc des Princes')->first())->save();

// GOLF
Competition::create(['jour' => '2024-07-25', 'heure_de_debut' => '09:00:00', 'heure_de_fin' => '19:00:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Golf')->first())->lieu()->associate(Lieu::where('nom', 'Golf National')->first())->save(); 
Competition::create(['jour' => '2024-08-07', 'heure_de_debut' => '09:00:00', 'heure_de_fin' => '19:00:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Golf')->first())->lieu()->associate(Lieu::where('nom', 'Golf National')->first())->save(); 
Competition::create(['jour' => '2024-08-08', 'heure_de_debut' => '09:00:00', 'heure_de_fin' => '19:00:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Golf')->first())->lieu()->associate(Lieu::where('nom', 'Golf National')->first())->save(); 

//GYMNASTIQUE ARTISTIQUE
Competition::create(['jour'=>'2024-07-28','heure_de_debut'=>'10:00:00','heure_de_fin'=>'12:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Gymnastique artistique')->first())->lieu()->associate(Lieu::where('nom', 'Arena Bercy')->first())->save();
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'13:00:00','heure_de_fin'=>'16:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Gymnastique artistique')->first())->lieu()->associate(Lieu::where('nom', 'Arena Bercy')->first())->save();
Competition::create(['jour'=>'2024-08-06','heure_de_debut'=>'17:00:00','heure_de_fin'=>'19:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Gymnastique artistique')->first())->lieu()->associate(Lieu::where('nom', 'Arena Bercy')->first())->save();

//GYMNASTIQUE RYTHMIQUE
Competition::create(['jour'=>'2024-07-29','heure_de_debut'=>'08:30:00','heure_de_fin'=>'11:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Gymnastique rythmique')->first())->lieu()->associate(Lieu::where('nom', 'Arena Porte de la Chapelle')->first())->save();
Competition::create(['jour'=>'2024-07-31','heure_de_debut'=>'12:00:00','heure_de_fin'=>'15:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Gymnastique rythmique')->first())->lieu()->associate(Lieu::where('nom', 'Arena Porte de la Chapelle')->first())->save();
Competition::create(['jour'=>'2024-08-07','heure_de_debut'=>'16:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Gymnastique rythmique')->first())->lieu()->associate(Lieu::where('nom', 'Arena Porte de la Chapelle')->first())->save();

// HALTEROPHILIE
Competition::create(['jour' => '2024-07-26', 'heure_de_debut' => '20:30:00', 'heure_de_fin' => '23:00:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Haltérophilie')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save(); 
Competition::create(['jour' => '2024-08-03', 'heure_de_debut' => '15:00:00', 'heure_de_fin' => '17:30:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Haltérophilie')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save(); 
Competition::create(['jour' => '2024-08-04', 'heure_de_debut' => '19:30:00', 'heure_de_fin' => '22:00:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Haltérophilie')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save(); 

// HANDBALL
Competition::create(['jour' => '2024-07-26', 'heure_de_debut' => '13:30:00', 'heure_de_fin' => '15:30:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Handball')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour' => '2024-08-06', 'heure_de_debut' => '17:30:00', 'heure_de_fin' => '19:30:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Handball')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save(); 
Competition::create(['jour' => '2024-08-07', 'heure_de_debut' => '21:30:00', 'heure_de_fin' => '23:30:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Handball')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();; 

// HOCKEY
Competition::create(['jour' => '2024-07-27', 'heure_de_debut' => '09:00:00', 'heure_de_fin' => '13:10:00', 'prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Hockey')->first())->lieu()->associate(Lieu::where('nom', 'Stade Yves-du-Manoir')->first())->save();
Competition::create(['jour' => '2024-07-28', 'heure_de_debut' => '09:30:00', 'heure_de_fin' => '12:40:00', 'prix' => 30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Hockey')->first())->lieu()->associate(Lieu::where('nom', 'Stade Yves-du-Manoir')->first())->save();
Competition::create(['jour' => '2024-08-03', 'heure_de_debut' => '09:30:00', 'heure_de_fin' => '11:40:00', 'prix' => 40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Hockey')->first())->lieu()->associate(Lieu::where('nom', 'Stade Yves-du-Manoir')->first())->save();

// JUDO
Competition::create(['jour'=>'2024-07-28','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Judo')->first())->lieu()->associate(Lieu::where('nom', 'Arena Champ de Mars')->first())->save();
Competition::create(['jour'=>'2024-07-31','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:40:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Judo')->first())->lieu()->associate(Lieu::where('nom', 'Arena Champ de Mars')->first())->save();
Competition::create(['jour'=>'2024-08-05','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:10:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Judo')->first())->lieu()->associate(Lieu::where('nom', 'Arena Champ de Mars')->first())->save();

// LUTTE
Competition::create(['jour'=>'2024-07-25','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:15:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Lutte')->first())->lieu()->associate(Lieu::where('nom', 'Arena Champ de Mars')->first())->save();
Competition::create(['jour'=>'2024-07-27','heure_de_debut'=>'18:30:00','heure_de_fin'=>'22:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Lutte')->first())->lieu()->associate(Lieu::where('nom', 'Arena Champ de Mars')->first())->save();
Competition::create(['jour'=>'2024-08-04','heure_de_debut'=>'18:30:00','heure_de_fin'=>'22:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Lutte')->first())->lieu()->associate(Lieu::where('nom', 'Arena Champ de Mars')->first())->save();

//MOUNTAIN BIKE (VTT)
Competition::create(['jour'=>'2024-07-27','heure_de_debut'=>'09:30:00','heure_de_fin'=>'11:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Mountain bike (VTT)')->first())->lieu()->associate(Lieu::where('nom', 'Colline d\'Elancourt')->first())->save();
Competition::create(['jour'=>'2024-07-29','heure_de_debut'=>'12:00:00','heure_de_fin'=>'15:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Mountain bike (VTT)')->first())->lieu()->associate(Lieu::where('nom', 'Colline d\'Elancourt')->first())->save();
Competition::create(['jour'=>'2024-08-05','heure_de_debut'=>'14:00:00','heure_de_fin'=>'17:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Mountain bike (VTT)')->first())->lieu()->associate(Lieu::where('nom', 'Colline d\'Elancourt')->first())->save();

// NATATION
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'11:00:00','heure_de_fin'=>'13:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Natation')->first())->lieu()->associate(Lieu::where('nom', 'Paris La Défense Arena à Nanterre')->first())->save();
Competition::create(['jour'=>'2024-08-04','heure_de_debut'=>'18:30:00','heure_de_fin'=>'22:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Natation')->first())->lieu()->associate(Lieu::where('nom', 'Paris La Défense Arena à Nanterre')->first())->save();
Competition::create(['jour'=>'2024-08-07','heure_de_debut'=>'20:30:00','heure_de_fin'=>'22:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Natation')->first())->lieu()->associate(Lieu::where('nom', 'Paris La Défense Arena à Nanterre')->first())->save();

//NATATION ARTISTIQUE
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'08:30:00','heure_de_fin'=>'10:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Natation artistique')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();
Competition::create(['jour'=>'2024-08-04','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Natation artistique')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();
Competition::create(['jour'=>'2024-08-11','heure_de_debut'=>'15:00:00','heure_de_fin'=>'17:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Natation artistique')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();

//NATATION MARATHON
Competition::create(['jour'=>'2024-08-03','heure_de_debut'=>'07:00:00','heure_de_fin'=>'09:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Natation marathon')->first())->lieu()->associate(Lieu::where('nom', 'Pont Alexandre III')->first())->save();
Competition::create(['jour'=>'2024-08-05','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Natation marathon')->first())->lieu()->associate(Lieu::where('nom', 'Pont Alexandre III')->first())->save();
Competition::create(['jour'=>'2024-08-10','heure_de_debut'=>'14:00:00','heure_de_fin'=>'16:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Natation marathon')->first())->lieu()->associate(Lieu::where('nom', 'Pont Alexandre III')->first())->save();

//PENTATHLON MODERNE
Competition::create(['jour'=>'2024-07-31','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Pentathlon moderne')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Nord')->first())->save();
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'13:00:00','heure_de_fin'=>'16:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Pentathlon moderne')->first())->lieu()->associate(Lieu::where('nom', 'Château de Versailles')->first())->save();
Competition::create(['jour'=>'2024-08-09','heure_de_debut'=>'17:00:00','heure_de_fin'=>'20:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Pentathlon moderne')->first())->lieu()->associate(Lieu::where('nom', 'Château de Versailles')->first())->save();

//PLONGEON
Competition::create(['jour'=>'2024-08-04','heure_de_debut'=>'10:30:00','heure_de_fin'=>'12:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Plongeon')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();
Competition::create(['jour'=>'2024-08-06','heure_de_debut'=>'13:00:00','heure_de_fin'=>'16:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Plongeon')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();
Competition::create(['jour'=>'2024-08-11','heure_de_debut'=>'17:00:00','heure_de_fin'=>'19:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Plongeon')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();

//RUGBY
Competition::create(['jour'=>'2024-08-01','heure_de_debut'=>'10:00:00','heure_de_fin'=>'13:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Rugby')->first())->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();
Competition::create(['jour'=>'2024-08-03','heure_de_debut'=>'14:00:00','heure_de_fin'=>'17:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Rugby')->first())->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();
Competition::create(['jour'=>'2024-08-10','heure_de_debut'=>'18:00:00','heure_de_fin'=>'21:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Rugby')->first())->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();

// SKATEBOARD
Competition::create(['jour'=>'2024-07-26','heure_de_debut'=>'12:00:00','heure_de_fin'=>'15:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Skateboard')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour'=>'2024-07-31','heure_de_debut'=>'17:00:00','heure_de_fin'=>'19:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Skateboard')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();
Competition::create(['jour'=>'2024-08-01','heure_de_debut'=>'12:30:00','heure_de_fin'=>'16:00:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Skateboard')->first())->lieu()->associate(Lieu::where('nom', 'Parc Urbain La Concorde')->first())->save();

//SPORTS EQUESTRES
Competition::create(['jour'=>'2024-08-06','heure_de_debut'=>'08:30:00','heure_de_fin'=>'11:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Sports équestres')->first())->lieu()->associate(Lieu::where('nom', 'Château de Versailles')->first())->save();
Competition::create(['jour'=>'2024-08-08','heure_de_debut'=>'12:00:00','heure_de_fin'=>'15:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Sports équestres')->first())->lieu()->associate(Lieu::where('nom', 'Château de Versailles')->first())->save();
Competition::create(['jour'=>'2024-08-11','heure_de_debut'=>'16:00:00','heure_de_fin'=>'19:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Sports équestres')->first())->lieu()->associate(Lieu::where('nom', 'Château de Versailles')->first())->save();

// SURF
Competition::create(['jour'=>'2024-07-27','heure_de_debut'=>'19:00:00','heure_de_fin'=>'04:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Surf')->first())->lieu()->associate(Lieu::where('nom', 'Teahupo\'o, Tahiti')->first())->save();
Competition::create(['jour'=>'2024-07-29','heure_de_debut'=>'19:00:00','heure_de_fin'=>'04:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Surf')->first())->lieu()->associate(Lieu::where('nom', 'Teahupo\'o, Tahiti')->first())->save();
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'19:00:00','heure_de_fin'=>'05:15:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Surf')->first())->lieu()->associate(Lieu::where('nom', 'Teahupo\'o, Tahiti')->first())->save();

// TAEKWONDO
Competition::create(['jour'=>'2024-07-25','heure_de_debut'=>'09:00:00','heure_de_fin'=>'12:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Taekwondo')->first())->lieu()->associate(Lieu::where('nom', 'Grand Palais')->first())->save();
Competition::create(['jour'=>'2024-07-29','heure_de_debut'=>'14:30:00','heure_de_fin'=>'17:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Taekwondo')->first())->lieu()->associate(Lieu::where('nom', 'Grand Palais')->first())->save();
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'19:30:00','heure_de_fin'=>'23:00:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Taekwondo')->first())->lieu()->associate(Lieu::where('nom', 'Grand Palais')->first())->save();

// TENNIS
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'12:00:00','heure_de_fin'=>'19:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Tennis')->first())->lieu()->associate(Lieu::where('nom', 'Stade Roland Garros')->first())->save();
Competition::create(['jour'=>'2024-08-03','heure_de_debut'=>'12:00:00','heure_de_fin'=>'19:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Tennis')->first())->lieu()->associate(Lieu::where('nom', 'Stade Roland Garros')->first())->save();
Competition::create(['jour'=>'2024-08-04','heure_de_debut'=>'18:30:00','heure_de_fin'=>'22:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Tennis')->first())->lieu()->associate(Lieu::where('nom', 'Stade Roland Garros')->first())->save();

//TENNIS DE TABLE
Competition::create(['jour'=>'2024-08-07','heure_de_debut'=>'07:30:00','heure_de_fin'=>'10:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Tennis de table')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour'=>'2024-08-09','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Tennis de table')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour'=>'2024-08-11','heure_de_debut'=>'15:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Tennis de table')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();

//TIR
Competition::create(['jour'=>'2024-08-08','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Tir')->first())->lieu()->associate(Lieu::where('nom', 'Centre National de Tir de Châteauroux')->first())->save();
Competition::create(['jour'=>'2024-08-10','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Tir')->first())->lieu()->associate(Lieu::where('nom', 'Centre National de Tir de Châteauroux')->first())->save();
Competition::create(['jour'=>'2024-08-11','heure_de_debut'=>'15:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Tir')->first())->lieu()->associate(Lieu::where('nom', 'Centre National de Tir de Châteauroux')->first())->save();

// TIR A L'ARC
Competition::create(['jour'=>'2024-07-25','heure_de_debut'=>'14:15:00','heure_de_fin'=>'17:15:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Tir à l\'arc')->first())->lieu()->associate(Lieu::where('nom', 'Invalides')->first())->save();
Competition::create(['jour'=>'2024-07-28','heure_de_debut'=>'18:30:00','heure_de_fin'=>'22:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Tir à l\'arc')->first())->lieu()->associate(Lieu::where('nom', 'Invalides')->first())->save();
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'13:00:00','heure_de_fin'=>'15:20:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Tir à l\'arc')->first())->lieu()->associate(Lieu::where('nom', 'Invalides')->first())->save();

//TRAMPOLINE
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Trampoline')->first())->lieu()->associate(Lieu::where('nom', 'Arena Bercy')->first())->save();
Competition::create(['jour'=>'2024-08-01','heure_de_debut'=>'12:00:00','heure_de_fin'=>'15:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Trampoline')->first())->lieu()->associate(Lieu::where('nom', 'Arena Bercy')->first())->save();
Competition::create(['jour'=>'2024-08-08','heure_de_debut'=>'16:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Trampoline')->first())->lieu()->associate(Lieu::where('nom', 'Arena Bercy')->first())->save();

// TRIATHLON
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Triathlon')->first())->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();
Competition::create(['jour'=>'2024-07-31','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:40:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Triathlon')->first())->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();
Competition::create(['jour'=>'2024-08-05','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:10:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Triathlon')->first())->lieu()->associate(Lieu::where('nom', 'Stade de France')->first())->save();

// VOILE
Competition::create(['jour'=>'2024-07-28','heure_de_debut'=>'12:00:00','heure_de_fin'=>'19:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Voile')->first())->lieu()->associate(Lieu::where('nom', 'Marina de Marseille')->first())->save();
Competition::create(['jour'=>'2024-08-02','heure_de_debut'=>'12:00:00','heure_de_fin'=>'19:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Voile')->first())->lieu()->associate(Lieu::where('nom', 'Marina de Marseille')->first())->save();
Competition::create(['jour'=>'2024-08-06','heure_de_debut'=>'12:00:00','heure_de_fin'=>'19:00:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Voile')->first())->lieu()->associate(Lieu::where('nom', 'Marina de Marseille')->first())->save();

// VOLLEYBALL
Competition::create(['jour'=>'2024-07-26','heure_de_debut'=>'09:00:00','heure_de_fin'=>'13:00:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Volleyball')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour'=>'2024-07-30','heure_de_debut'=>'16:00:00','heure_de_fin'=>'20:00:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Volleyball')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour'=>'2024-07-31','heure_de_debut'=>'13:00:00','heure_de_fin'=>'17:15:00','prix'=>40.00, 'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Volleyball')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();

//VOLLEYBALL DE PLAGE
Competition::create(['jour'=>'2024-08-09','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Volleyball de plage')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour'=>'2024-08-10','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Volleyball de plage')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();
Competition::create(['jour'=>'2024-08-11','heure_de_debut'=>'15:00:00','heure_de_fin'=>'18:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Volleyball de plage')->first())->lieu()->associate(Lieu::where('nom', 'Arena Paris Sud')->first())->save();

//WATERPOLO
Competition::create(['jour'=>'2024-08-05','heure_de_debut'=>'08:00:00','heure_de_fin'=>'10:30:00','prix'=>20.00,'type'=>'1er tour'])->sport()->associate(Sport::where('nom', 'Waterpolo')->first())->lieu()->associate(Lieu::where('nom', 'Centre Aquatique')->first())->save();
Competition::create(['jour'=>'2024-08-07','heure_de_debut'=>'11:00:00','heure_de_fin'=>'14:30:00','prix'=>30.00,'type'=>'Demi-Finale'])->sport()->associate(Sport::where('nom', 'Waterpolo')->first())->lieu()->associate(Lieu::where('nom', 'Paris La Défense Arena à Nanterre')->first())->save();
Competition::create(['jour'=>'2024-08-10','heure_de_debut'=>'15:00:00','heure_de_fin'=>'17:30:00','prix'=>40.00,'type'=>'Finale'])->sport()->associate(Sport::where('nom', 'Waterpolo')->first())->lieu()->associate(Lieu::where('nom', 'Paris La Défense Arena à Nanterre')->first())->save();

return "Les compétitions ont été enregistrés avec succès.";

}  



}