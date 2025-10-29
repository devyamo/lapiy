<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Phc;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('phc')->where('phc_id', auth()->user()->phc_id)->get();
        
        return Inertia::render('Patients/Index', [
            'patients' => $patients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Patients/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'woman_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:50',
            'literacy_status' => 'required|in:Literate,Not Literate',
            'phone_number' => 'nullable|string',
            'community' => 'required|string',
            'address' => 'required|string',
            'ward' => 'required|string',
            'lga' => 'required|string',
            'date_of_registration' => 'required|date',
            'edd' => 'required|date',
        ]);

        $validated['phc_id'] = auth()->user()->phc_id;

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully!');
    }

    public function show(Patient $patient)
    {
        return Inertia::render('Patients/Show', [
            'patient' => $patient->load('phc'),
        ]);
    }
}