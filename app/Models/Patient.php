<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id', 'phc_id', 'woman_name', 'age', 'literacy_status', 'phone_number',
        'husband_name', 'husband_phone', 'community', 'address', 'ward', 'lga',
        'gravida', 'parity', 'date_of_registration', 'edd', 'anc_visit_1', 'tracked_before_anc1',
        'anc_visit_2', 'tracked_before_anc2', 'anc_visit_3', 'tracked_before_anc3',
        'anc_visit_4', 'tracked_before_anc4', 'additional_anc', 'place_of_delivery',
        'received_delivery_kits', 'type_of_delivery', 'delivery_outcome', 'date_of_delivery',
        'child_immunization', 'fp_interest_postpartum', 'fp_given', 'fp_paid', 'fp_amount_paid',
        'reason_fp_not_given', 'health_insurance', 'happy_with_insurance', 'paid_for_anc',
        'anc_amount_paid', 'pnc_visit_1', 'pnc_visit_2', 'remark', 'comments'
    ];

    protected $casts = [
        'date_of_registration' => 'date',
        'edd' => 'date',
        'anc_visit_1' => 'date',
        'anc_visit_2' => 'date',
        'anc_visit_3' => 'date',
        'anc_visit_4' => 'date',
        'date_of_delivery' => 'date',
        'pnc_visit_1' => 'date',
        'pnc_visit_2' => 'date',
    ];

    public function phc()
    {
        return $this->belongsTo(Phc::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            // Generate unique ID: LGA code (3 letters) / Ward code (3 letters) / serial number
            $lgaCode = strtoupper(substr($patient->lga, 0, 3));
            $wardCode = strtoupper(substr($patient->ward, 0, 3));
            $serial = Patient::where('lga', $patient->lga)
                            ->where('ward', $patient->ward)
                            ->count() + 1;
            $patient->unique_id = $lgaCode . '/' . $wardCode . '/' . $serial;
        });

        static::saving(function ($patient) {
            // Calculate ANC visits count
            $patient->anc_visits_count = $patient->calculateAncVisitsCount();
            
            // Check if ANC4 is completed
            $patient->anc4_completed = !is_null($patient->anc_visit_4);
            
            // Check if PNC is completed
            $patient->pnc_completed = !is_null($patient->pnc_visit_1) && !is_null($patient->pnc_visit_2);
            
            // Calculate post-EDD follow-up status
            $patient->post_edd_followup_status = $patient->calculatePostEddStatus();
            
            // Generate alert
            $patient->alert = $patient->generateAlert();
        });
    }

    private function calculateAncVisitsCount()
    {
        $count = 0;
        $visits = ['anc_visit_1', 'anc_visit_2', 'anc_visit_3', 'anc_visit_4'];
        
        foreach ($visits as $visit) {
            if (!is_null($this->$visit)) {
                $count++;
            }
        }
        
        return $count;
    }

    private function calculatePostEddStatus()
    {
        if (is_null($this->edd)) {
            return null;
        }

        $today = Carbon::today();
        $edd = Carbon::parse($this->edd);

        if ($today->gt($edd) && is_null($this->date_of_delivery)) {
            return 'Missed Follow-up';
        }

        return 'On Track';
    }

    private function generateAlert()
    {
        if ($this->anc_visits_count < 4) {
            return "Needs ANC " . ($this->anc_visits_count + 1);
        }

        $today = Carbon::today();
        $edd = Carbon::parse($this->edd);

        if ($today->gt($edd) && is_null($this->date_of_delivery)) {
            return "Follow-up delivery";
        }

        if (!is_null($this->date_of_delivery) && !$this->pnc_completed) {
            return "Schedule PNC";
        }

        return "Up to date";
    }
}