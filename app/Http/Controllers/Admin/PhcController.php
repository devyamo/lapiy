<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lga;
use App\Models\Phc;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PhcController extends Controller
{
    public function index()
    {
        $phcs = Phc::with(['lga', 'ward', 'users'])->get();
        
        return Inertia::render('dashboard/Admin', [
            'phcs' => $phcs,
            'lgas' => Lga::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'clinic_name' => 'required|string|max:255',
            'lga_id' => 'required|exists:lgas,id',
            'ward_id' => 'required|exists:wards,id',
            'staff_name' => 'required|string|max:255',
            'staff_email' => 'required|email|unique:users,email',
            'staff_password' => 'required|string|min:8',
        ]);

        DB::transaction(function () use ($validated) {
            $phc = Phc::create([
                'clinic_name' => $validated['clinic_name'],
                'lga_id' => $validated['lga_id'],
                'ward_id' => $validated['ward_id'],
            ]);

            User::create([
                'name' => $validated['staff_name'],
                'email' => $validated['staff_email'],
                'password' => Hash::make($validated['staff_password']),
                'role' => 'phc_staff',
                'phc_id' => $phc->id,
                'email_verified_at' => now(),
            ]);
        });

        return redirect()->back()->with('success', 'PHC and staff user created successfully!');
    }

    public function getWardsByLga($lgaId)
    {
        $wards = Ward::where('lga_id', $lgaId)->get();
        return response()->json($wards);
    }

    public function destroy(Phc $phc)
    {
        $phc->delete();
        return redirect()->back()->with('success', 'PHC deleted successfully!');
    }
}
