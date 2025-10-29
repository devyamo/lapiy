<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Patient;
use App\Models\Phc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->phcStaffDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_phcs' => Phc::count(),
            'total_patients' => Patient::count(),
            'total_staff' => User::where('role', 'phc_staff')->count(),
            'patients_needing_anc' => Patient::where('anc4_completed', false)
                ->whereNull('date_of_delivery')
                ->count(),
            'patients_needing_pnc' => Patient::where('pnc_completed', false)
                ->whereNotNull('date_of_delivery')
                ->count(),
            'overdue_deliveries' => Patient::whereDate('edd', '<', now())
                ->whereNull('date_of_delivery')
                ->count(),
        ];

        $phcs = Phc::with(['lga', 'ward'])->withCount('patients')->get();
        $lgas = Lga::all();

        $recentPatients = Patient::with(['phc', 'lga', 'ward'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $ancDistribution = [
            'anc1' => Patient::where('anc_visits_count', '>=', 1)->count(),
            'anc2' => Patient::where('anc_visits_count', '>=', 2)->count(),
            'anc3' => Patient::where('anc_visits_count', '>=', 3)->count(),
            'anc4' => Patient::where('anc4_completed', true)->count(),
        ];

        return Inertia::render('dashboard/Admin', [
            'stats' => $stats,
            'phcs' => $phcs,
            'lgas' => $lgas,
            'recentPatients' => $recentPatients,
            'ancDistribution' => $ancDistribution,
        ]);
    }

    private function phcStaffDashboard()
    {
        $phcId = Auth::user()->phc_id;

        $stats = [
            'total_patients' => Patient::where('phc_id', $phcId)->count(),
            'patients_needing_anc' => Patient::where('phc_id', $phcId)
                ->where('anc4_completed', false)
                ->whereNull('date_of_delivery')
                ->count(),
            'patients_needing_pnc' => Patient::where('phc_id', $phcId)
                ->where('pnc_completed', false)
                ->whereNotNull('date_of_delivery')
                ->count(),
            'overdue_deliveries' => Patient::where('phc_id', $phcId)
                ->whereDate('edd', '<', now())
                ->whereNull('date_of_delivery')
                ->count(),
        ];

        $recentPatients = Patient::with(['lga', 'ward'])
            ->where('phc_id', $phcId)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $alerts = Patient::where('phc_id', $phcId)
            ->whereNotNull('alert')
            ->where('alert', '!=', 'Up to date')
            ->get();

        return Inertia::render('dashboard/PhcStaff', [
            'stats' => $stats,
            'recentPatients' => $recentPatients,
            'alerts' => $alerts,
        ]);
    }
}
