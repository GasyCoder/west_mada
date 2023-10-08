<?php

namespace App\Livewire;

use DateTime;
use Carbon\Carbon;
use App\Models\Hotel;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Models\Disponibilite;
use Livewire\Attributes\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }
    #[Rule('required')]
    public $date_debut = '';
    #[Rule('required')]
    public $date_fin = '';
    #[Rule('required')]
    public $hotel_id = '';
    #[Rule('required')]
    public $client_name = '';
    #[Rule('required')]
    public $phone = '';
    #[Rule('required')]
    public $sexe;
    #[Rule('nullable')]
    public $email;
    public $pourcent = 100;
    public $page =  10;
    public $currentStep = 1;
    public $is_active = 0;
    public $checkin = '14:00:00';
    public $checkout = '12:00:00';
    public $search, $isConfirmed, $isPending = '';
    public $confirmingTrash, $confirmingAnnuler, $confirmingTermine, $confirmingPending;
    public $description, $montant, $statut, $hotel, $montantInitial, $ref,
    $user_id, $selected_id, $hotel_type, $created_at;
    public $showPrixTotal, $isHotelAvailable, $showField = false;


    public function toggleConfirmed()
    {
        $this->isConfirmed = !$this->isConfirmed;
    }

    public function togglePending()
    {
        $this->isPending = !$this->isPending;
    }

    public function render()
    {
        $this->authorize('booking-list');
        $hotels = Hotel::where('is_active', true)->get();
        $search = '%' . $this->search . '%';

        $query = Reservation::where(function ($query) {
            $query->where('statut', 'confirmée')
            ->orWhere('statut', 'en_attente');
        });

        if ($this->isConfirmed) {
            $query->where('statut', 'confirmée');
        }
        if ($this->isPending) {
            $query->where('statut', 'en_attente');
        }
        $query->where(function ($query) use ($search) {
            $query->where('phone', 'LIKE', $search)
                ->orWhere('client_name', 'LIKE', $search)
                ->orWhere('ref', 'LIKE', $search)
                ->orWhere('date_debut', 'LIKE', $search)
                ->orWhere('date_fin', 'LIKE', $search)
                ->orWhereHas('hotel.roomType', function ($query) use ($search) {
                    $query->where('name', 'LIKE', $search);
                });
        });

        $reservations = $query->latest()->paginate($this->page);
        $reservationTotale  = Disponibilite::count();
        $confirme = Reservation::where('statut', 'confirmée')->count();
        $enAttente = Reservation::where('statut', 'en_attente')->count();
        $terminer = Reservation::where('statut', 'terminé')->count();
        $annuler = Reservation::where('statut', 'annulé')->count();
        $rembourser = Reservation::where('statut', 'remboursé')->count();
        $trash = Reservation::where('deleted', true)->count();

        $reservationCounts = getReservationCounts();
        $counts = calculateCounts($reservationCounts);

        // Calcul du nombre de jours pour chaque réservation
        $reservations->transform(function ($reservation) {
            $dateDebut = Carbon::parse($reservation->date_debut);
            $dateFin = Carbon::parse($reservation->date_fin);
            $reservation->nombreDeJours = $dateDebut->diffInDays($dateFin);
            return $reservation;
        }); 
        
        return view('livewire.dashboard', [
            'hotels' => $hotels,
            'reservations' => $reservations,
            'reservationTotale' => $reservationTotale,
            'counts'    => $counts,
            'confirme'  => $confirme,
            'enAttente' => $enAttente,
            'terminer'  => $terminer,
            'annuler'   => $annuler,
            'rembourser' => $rembourser,
            'trash'      => $trash,
        ]);
    }

    public function store()
    {
        $this->authorize('booking-create');
        $this->validate();
        $user = auth()->user();
        if ($user->hasRole('admin') || $user->hasRole('employe')) {
            $attributes = $this->all();
            $attributes['statut'] = ($this->is_active > 0) ? 'confirmée' : 'en_attente';
            $attributes['user_id'] = $user->id;
            $reservation = Reservation::create($attributes);
            Disponibilite::create([
                'hotel_id'      => $reservation->hotel_id,
                'date_debut'    => $reservation->date_debut,
                'date_fin'      => $reservation->date_fin,
                'checkin'       => '14:00:00',
                'checkout'      => '12:00:00',
                'disponible'    => true,
                //'disponible'    => boolval($reservation->is_active),
            ]);
            $this->reset();
            session()->flash('success', 'Reservation ajouté avec succès!');
        } else {
            session()->flash('error', 'Vous n\'avez pas les autorisations nécessaires pour effectuer cette opération.');
        }
    }
    public $nbreJours;
    //Show detail of client here
    public function show($id)
    {
        $this->authorize('booking-view');
        $detail = Reservation::findorFail($id);
        $this->selected_id  = $id;
        $this->client_name  = $detail->client_name;
        $this->phone        = $detail->phone;
        $this->hotel_id     = $detail->hotel->room_number;
        $this->hotel_type   = $detail->hotel->roomType->name;
        $this->date_debut   = $detail->date_debut->format('d-M-Y');
        $this->date_fin     = $detail-> date_fin->format('d-M-Y');
        $this->pourcent     = $detail->pourcent;
        $this->montant      = $detail->montant;
        $this->statut       = $detail->statut;
        $this->user_id      = $detail->user->name;
        $this->created_at    = Carbon::parse($detail->created_at)->diffForHumans();

        $dateDebut = Carbon::parse($detail->date_debut);
        $dateFin = Carbon::parse($detail->date_fin);
        $this->nbreJours = $dateDebut->diffInDays($dateFin);

    }
    //Reservation est en attente avec paiement 50%
    public function confirmPending($id)
    {
        $this->confirmingPending = $id;
    }

    //Show detail of client here
    public function edit($id)
    {
        $this->authorize('booking-edit');
        $detail = Reservation::findorFail($id);
        $this->selected_id  = $id;
        $this->client_name  = $detail->client_name;
        $this->date_debut   = $detail->date_debut->format('Y-m-d');
        $this->date_fin     = $detail->date_fin->format('Y-m-d');

        $this->created_at    = Carbon::parse($detail->created_at)->diffForHumans();
    }

    public function update()
    {
        $this->validate([
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);
        $update = Reservation::find($this->selected_id);
        $update->update([
            'date_debut'    => $this->date_debut,
            'date_fin'      => $this->date_fin,
        ]);
        $this->reset();
        Alert::success('Merci,', 'Modification avec succès!');
        return redirect()->to('/dashboard');
    }

    public function confirmer($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'is_active' => true,
            'statut'    => 'confirmée',
            'pourcent'  => $reservation->pourcent + 50,
            'montant'   => $reservation->montant * 2
        ]);

        $disponibilite = Disponibilite::where('hotel_id', $reservation->hotel_id)
            ->where('date_debut', $reservation->date_debut)
            ->where('date_fin', $reservation->date_fin)
            ->first();

        if ($disponibilite) {
            $disponibilite->update([
                'disponible' => true,
            ]);
        }

        $this->showMessage('Opération activée avec succès !');
    }


    //Reservation est confirmé avec paiement complet 100%
    public function confirmTerminer($id)
    {
        $this->confirmingTermine = $id;
    }
    public function terminer($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'is_active' => false,
            'statut'    => 'terminé',
        ]);
        $disponibilite = Disponibilite::where('hotel_id', $reservation->hotel_id)
            ->where('date_debut', $reservation->date_debut)
            ->where('date_fin', $reservation->date_fin)
            ->first();
        if ($disponibilite) {
            $disponibilite->delete(); 
        }
        $this->showMessage('Opération terminée avec succès !');
    }


    //Reservation est Annulé
    public function confirmAnnuler($id)
    {
        $this->confirmingAnnuler = $id;
    }

    public function annuler($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'is_active' => false,
            'statut'    => 'annulé',
        ]);

        $disponibilite = Disponibilite::where('hotel_id', $reservation->hotel_id)
            ->where('date_debut', $reservation->date_debut)
            ->where('date_fin', $reservation->date_fin)
            ->first();
        if ($disponibilite) {
            $disponibilite->delete(); // Utilisez la méthode "delete" pour supprimer l'entrée
        }
        $this->showMessage('Opération annulée avec succès !');
    }


    public function populate($id)
    {
        $hotel = Hotel::findOrFail($id);
        $this->montant = $hotel->tarif;
        $this->showPrixTotal = true;
    }
    public function mount()
    {
        $this->montantInitial = $this->montant;
    }
    public function montantBypourcent()
    {
        if ($this->pourcent === 100) {
            $this->montant = $this->montantInitial;
        } else {
            if ($this->montantInitial === null) {
                $this->montantInitial = $this->montant;
            }
            $this->montant = getPourcent($this->montantInitial, $this->pourcent);
        }
    }


    // Step Form 
    public function nextStep()
    {
        if ($this->currentStep === 1) {
            Validator::make([
                'date_debut' => $this->date_debut,
                'date_fin' => $this->date_fin,
                'hotel_id' => $this->hotel_id,
            ], [
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after_or_equal:date_debut',
                'hotel_id' => 'required|exists:hotels,id',
            ])->validate();
        } elseif ($this->currentStep === 2) {
            $rules = [
                'client_name' => 'required|string',
                'phone' => 'required|string',
                'description' => 'nullable',
            ];

            if ($this->showPrixTotal) {
                $rules['prix_total'] = 'required|numeric';
                $rules['pourcent'] = 'required|in:50,100';
            }

            Validator::make([
                'client_name' => $this->client_name,
                'phone' => $this->phone,
                'description' => $this->description,
                'prix_total' => $this->montant,
                'pourcent' => $this->pourcent,
            ], $rules)->validate();
        }

        $this->currentStep++;
    }

    public function prevStep()
    {
        $this->currentStep--;
    }

    public function checkAvailability()
    {
        $this->authorize('booking-checking');
        $this->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'hotel_id' => 'required|exists:hotels,id',
        ]);

        $existingReservations = Disponibilite::where('hotel_id', $this->hotel_id)
            ->orderBy('date_debut', 'asc')
            ->get();

        // Calcul des heures de check-in et de check-out
        $checkInTime = new DateTime($this->date_debut);
        $checkOutTime = new DateTime($this->date_fin);
        $cleaningTime = new DateTime($this->date_debut);

        $checkInTime->setTime(14, 0); // Heure de check-in
        $checkOutTime->setTime(12, 0); // Heure de check-out
        $cleaningTime->setTime(13, 0); // Heure de nettoyage

        // Vérification de la disponibilité
        $isHotelAvailable = true;
        $lastReservationEndDate = null;

        foreach ($existingReservations as $existingReservation) {
            $existingReservationStartDate = new DateTime($existingReservation->date_debut);
            $existingReservationEndDate = new DateTime($existingReservation->date_fin);

            // Vérification du chevauchement en tenant compte des heures de check-in et de check-out
            if (
                $checkOutTime >= $existingReservationStartDate &&
                $checkInTime <= $existingReservationEndDate
            ) {
                $isHotelAvailable = false;
                break;
            }

            // Vérification de la période de nettoyage
            if (
                $lastReservationEndDate !== null &&
                $cleaningTime < $existingReservationStartDate
            ) {
                $isHotelAvailable = false;
                break;
            }

            $lastReservationEndDate = $existingReservationEndDate;
        }

        // Reste du code pour afficher les messages en conséquence
        if ($isHotelAvailable) {
            session()->flash('success', 'La chambre est disponible pour les dates sélectionnées. Passez la reservation.');
        } else {
            session()->flash('error', 'La chambre n\'est pas disponible pour les dates sélectionnées en raison de réservations existantes.');
        }

        $this->isHotelAvailable = $isHotelAvailable;
        $this->showField = $isHotelAvailable;
    }

    public $booking = false;
    public function changed()
    {
        $this->booking = !$this->booking;
    }
}