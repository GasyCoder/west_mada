<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Hotel;
use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Models\Disponibilite;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TrashReservation extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public function showMessage($message)
    {
        $this->dispatch('showSuccessMessage', ['message' => $message]);
    }

    public $page = 5;
    public $date_debut = '';
    public $date_fin = '';
    public $hotel_id = '';
    public $client_name = '';
    public $phone = '';
    public $sexe;
    public $person_total;
    public $pourcent = 100;
    public $checkin = '14:00:00';
    public $checkout = '12:00:00';
    public $search, $isConfirmed, $isPending, $isAnnuler, $isTerminer, $isRembourse = '';
    public $confirmingDelete, $confirmingAnnuler, $confirmingTermine, $confirmingPending;
    public $description, $montant, $statut, $hotel,
        $user_id, $selected_id, $hotel_type, $created_at;
    public $showPrixTotal, $isHotelAvailable, $showField = false;
    public $currentStep = 1;
    public $is_active = 0;

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
        $this->date_fin     = $detail->date_fin->format('d-M-Y');
        $this->pourcent     = $detail->pourcent;
        $this->montant      = $detail->montant;
        $this->statut       = $detail->statut;
        $this->user_id      = $detail->user->name;
        $this->created_at    = Carbon::parse($detail->created_at)->diffForHumans();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }

    public function kill($id)
    {
        Reservation::destroy($id);
    }

    //Reservation est encore en attente peut-être avec paiement 50%
    public function confirmPending($id)
    {
        $this->confirmingPending = $id;
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

    //Reservation est encore confirmé avec paiement complet 100%
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
            $disponibilite->delete(); // Utilisez la méthode "delete" pour supprimer l'entrée
        }

        $this->showMessage('Opération terminée avec succès !');
    }

    public function confirmCancel($id)
    {
        $this->confirmingAnnuler = $id;
    }
    //Reservation est déjà annulé
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


    public function toggleConfirmed()
    {
        $this->isConfirmed = !$this->isConfirmed;
    }

    public function togglePending()
    {
        $this->isPending = !$this->isPending;
    }

    public function toggleAnnuler()
    {
        $this->isAnnuler = !$this->isAnnuler;
    }

    public function toggleTerminer()
    {
        $this->isTerminer = !$this->isTerminer;
    }



    public function render()
    {
        $this->authorize('booking-list');
        $hotels = Hotel::where('is_active', true)->get();

        $query = Reservation::where(function ($query) {
            $query->where('statut', 'terminé')
            ->orWhere('statut', 'annulé')
                ->orWhere('statut', 'remboursé');
        });

        if ($this->isAnnuler) {
            $query->where('statut', 'annulé');
        }

        if ($this->isTerminer) {
            $query->where('statut', 'terminé');
        }

        if ($this->isRembourse) {
            $query->where('statut', 'remboursé');
        }

        $query->where(function ($query) {
            $search = '%' . $this->search . '%';
            $query->where('phone', 'LIKE', $search)
                ->orWhere('client_name', 'LIKE', $search)
                ->orWhere('date_debut', 'LIKE', $search)
                ->orWhere('date_fin', 'LIKE', $search)
                ->orWhereHas('hotel.roomType', function ($query) use ($search) {
                    $query->where('name', 'LIKE', $search);
                });
        });

        $reservations = $query->latest()->where('deleted', true)->paginate($this->page);

        // Calcul du nombre de jours pour chaque réservation
        $reservations->transform(function ($reservation) {
            $dateDebut = Carbon::parse($reservation->date_debut);
            $dateFin = Carbon::parse($reservation->date_fin);
            $reservation->nombreDeJours = $dateDebut->diffInDays($dateFin);
            return $reservation;
        }); 
        
        return view('livewire.booking.trash.index', [
            'reservations' => $reservations,
            'hotels'  => $hotels
        ]);
    }
}
