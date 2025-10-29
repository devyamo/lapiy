<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Patient;
use App\Models\Ward;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with(['phc', 'lga', 'ward'])
            ->where('phc_id', auth()->user()->phc_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return Inertia::render('Patients/Index', [
            'patients' => $patients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Patients/Create', [
            'lgas' => Lga::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'woman_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:50',
            'literacy_status' => 'required|in:Literate,Not Literate',
            'phone_number' => 'nullable|string',
            'husband_name' => 'nullable|string|max:255',
            'husband_phone' => 'nullable|string',
            'community' => 'required|string',
            'address' => 'required|string',
            'ward_id' => 'required|exists:wards,id',
            'lga_id' => 'required|exists:lgas,id',
            'gravida' => 'nullable|integer',
            'parity' => 'nullable|integer',
            'date_of_registration' => 'required|date',
            'edd' => 'required|date|after:date_of_registration',
            'health_insurance' => 'nullable|string',
        ]);

        $validated['phc_id'] = auth()->user()->phc_id;

        Patient::create($validated);

        return redirect()->route('patients.index')->with('success', 'Patient registered successfully!');
    }

    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);
        
        return Inertia::render('Patients/Show', [
            'patient' => $patient->load(['phc', 'lga', 'ward']),
        ]);
    }

    public function edit(Patient $patient)
    {
        $this->authorize('update', $patient);
        
        return Inertia::render('Patients/Edit', [
            'patient' => $patient->load(['lga', 'ward']),
            'lgas' => Lga::all(),
        ]);
    }

    public function update(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        
        $validated = $request->validate([
            'woman_name' => 'required|string|max:255',
            'age' => 'required|integer|min:15|max:50',
            'literacy_status' => 'required|in:Literate,Not Literate',
            'phone_number' => 'nullable|string',
            'husband_name' => 'nullable|string|max:255',
            'husband_phone' => 'nullable|string',
            'community' => 'required|string',
            'address' => 'required|string',
            'anc_visit_1' => 'nullable|date',
            'anc_visit_2' => 'nullable|date',
            'anc_visit_3' => 'nullable|date',
            'anc_visit_4' => 'nullable|date',
            'date_of_delivery' => 'nullable|date',
            'place_of_delivery' => 'nullable|in:PHC,Secondary,Tertiary,Home,TBA',
            'type_of_delivery' => 'nullable|in:Vaginal,Assisted,Cesarean,Breech',
            'delivery_outcome' => 'nullable|in:Live birth,Stillbirth,Referral,Complication',
            'pnc_visit_1' => 'nullable|date',
            'pnc_visit_2' => 'nullable|date',
            'remark' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.show', $patient)->with('success', 'Patient updated successfully!');
    }

    public function destroy(Patient $patient)
    {
        $this->authorize('delete', $patient);
        
        $patient->delete();

        return redirect()->route('patients.index')->with('success', 'Patient deleted successfully!');
    }

    public function getLgas()
    {
        return response()->json(Lga::all());
    }

    public function getWardsByLga($lgaId)
    {
        $wards = Ward::where('lga_id', $lgaId)->get();
        return response()->json($wards);
    }
}