<?php

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Periode;
use App\Models\Reservation;
use App\Models\CategoryStock;
use Illuminate\Support\Facades\Validator;

// In helpers.php
function getTasksData($userId, $periodId, $search, $perPage)
{
    $user = User::find($userId); // Replace User with your actual User model

    if ($user->hasRole('admin')) {
        // Allow admin to access all periods, regardless of is_active status
        $periods = Periode::all();
    } elseif ($user->hasRole('employe')) {
        // Allow employees to access only active periods
        $periods = Periode::where('is_active', true)->get();
    } else {
        // For other roles or unknown roles, return an empty collection
        $periods = collect([]);
    }

    $period = $periods->find($periodId);

    if (!$period) {
        // Return an array indicating the period was not found
        return [
            'period' => null,
            'tasks' => collect([]),
            'notFound' => true, // Add a flag to indicate the period was not found
        ];
    }

    $tasks = Task::where('period_id', $period->id)
        ->leftJoin("stocks", 'tasks.stock_id', '=', 'stocks.id')
        ->select('tasks.*', 'stocks.name as stock_name')
        ->where(function ($query) use ($search) {
            $query->where('stocks.name', 'LIKE', $search)
                ->orWhere('tasks.type', 'LIKE', $search)
                ->orWhere('tasks.uuid', 'LIKE', "%$search%") // Search for the UUID
                ->orWhere('tasks.reference', 'LIKE', "%$search%")
                ->orWhere('tasks.by_date', 'LIKE', "%$search%"); // Search for the simplified numeric value
        })->paginate($perPage);

    return [    
        'period' => $period,
        'tasks' => $tasks,
        'notFound' => false,
    ];
}


// In helpers.php
function getPeriodsData($search, $page)
{
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        // Admin can access all periods without any filters
        $periods = Periode::paginate($page);
        $getperiod = Periode::count(); // Count all periods
    } else {
        // Non-admin users can only access active periods
        $periods = Periode::where('is_active', true)
            ->where(function ($query) use ($search) {
                $query->where('created_at', 'LIKE', $search)
                    ->orWhere('mois', 'LIKE', $search);
            })
            ->paginate($page);
        $getperiod = Periode::where('is_active', true)->count(); // Count only active periods
    }

    return [
        'periods' => $periods,
        'getperiod' => $getperiod,
    ];

}

// helper.php
function getPourcent($montant, $pourcent)
{
    return $montant * ($pourcent / 100);
}

function getReservationCounts()
{
    $reservationCounts = Reservation::selectRaw('YEAR(date_debut) as year, MONTH(date_debut) as month, COUNT(*) as count')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

    return $reservationCounts;
}

function calculateCounts($reservationCounts)
{
    $currentYear = now()->year;
    $currentMonth = now()->month;
    $startOfWeek = now()->startOfWeek();
    $endOfWeek = now()->endOfWeek();
    $countThisMonth = 0;
    $countThisWeek = 0;
    foreach ($reservationCounts as $count) {
        if ($count->year == $currentYear && $count->month == $currentMonth) {
            $countThisMonth = $count->count;
        }
        $date = Carbon::create($count->year, $count->month);
        if ($date->between($startOfWeek, $endOfWeek)) {
            $countThisWeek += $count->count;
        }
    }
    return [
        'countThisMonth' => $countThisMonth,
        'countThisWeek' => $countThisWeek,
    ];
}


// helper.php

function validateStepOne($data)
{
    return validator($data, [
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'hotel_id' => 'required|exists:hotels,id',
    ])->validate();
}

function validateStepTwo($data, $showPrixTotal)
{
    $rules = [
        'client_name' => 'required|string',
        'phone' => 'required|string',
        'description' => 'nullable',
    ];

    if ($showPrixTotal) {
        $rules['prix_total'] = 'required|numeric';
        $rules['pourcent'] = 'required|in:50,100';
    }

    return validator($data, $rules)->validate();
}


function checkAvailability($date_debut, $date_fin, $hotel_id)
{
    // Validation des dates et de l'ID de l'hôtel
    $validator = Validator::make([
        'date_debut' => $date_debut,
        'date_fin' => $date_fin,
        'hotel_id' => $hotel_id,
    ], [
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'hotel_id' => 'required|exists:hotels,id',
    ]);

    if ($validator->fails()) {
        return ['error' => 'Veuillez vérifier les dates et l\'ID de l\'hôtel.'];
    }

    // Le reste de la logique de vérification de la disponibilité
    $isHotelAvailable = true; // Initialisation de la disponibilité

    // ... (reprenez le code précédent à partir d'ici)

    if ($isHotelAvailable) {
        return ['success' => 'La chambre est disponible pour les dates sélectionnées. Le prochain client peut s\'enregistrer à partir de 14h00. Assurez-vous de planifier le nettoyage entre 12h00 et 13h00.'];
    } else {
        return ['error' => 'La chambre n\'est pas disponible pour les dates sélectionnées en raison de réservations existantes. Assurez-vous de coordonner le nettoyage et la disponibilité des chambres pour éviter les chevauchements.'];
    }
}

