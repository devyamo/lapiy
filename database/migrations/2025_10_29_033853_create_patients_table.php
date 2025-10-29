<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->foreignId('phc_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('woman_name');
            $table->integer('age');
            $table->enum('literacy_status', ['Literate', 'Not Literate']);
            $table->string('phone_number')->nullable();
            $table->string('husband_name')->nullable();
            $table->string('husband_phone')->nullable();
            $table->string('community');
            $table->text('address');
            $table->string('ward');
            $table->string('lga');
            
            // Medical Information
            $table->integer('gravida')->nullable();
            $table->integer('parity')->nullable();
            $table->date('date_of_registration');
            $table->date('edd');
            
            // ANC Visits
            $table->date('anc_visit_1')->nullable();
            $table->boolean('tracked_before_anc1')->default(false);
            $table->date('anc_visit_2')->nullable();
            $table->boolean('tracked_before_anc2')->default(false);
            $table->date('anc_visit_3')->nullable();
            $table->boolean('tracked_before_anc3')->default(false);
            $table->date('anc_visit_4')->nullable();
            $table->boolean('tracked_before_anc4')->default(false);
            $table->text('additional_anc')->nullable();
            
            // Delivery Information
            $table->enum('place_of_delivery', ['PHC', 'Secondary', 'Tertiary', 'Home', 'TBA'])->nullable();
            $table->boolean('received_delivery_kits')->default(false);
            $table->enum('type_of_delivery', ['Vaginal', 'Assisted', 'Cesarean', 'Breech'])->nullable();
            $table->enum('delivery_outcome', ['Live birth', 'Stillbirth', 'Referral', 'Complication'])->nullable();
            $table->date('date_of_delivery')->nullable();
            
            // Postpartum Information
            $table->enum('child_immunization', ['Yes', 'No'])->nullable();
            $table->boolean('fp_interest_postpartum')->default(false);
            $table->boolean('fp_given')->default(false);
            $table->boolean('fp_paid')->default(false);
            $table->decimal('fp_amount_paid', 10, 2)->nullable();
            $table->text('reason_fp_not_given')->nullable();
            
            // Health Insurance
            $table->string('health_insurance')->nullable();
            $table->boolean('happy_with_insurance')->default(false);
            $table->boolean('paid_for_anc')->default(false);
            $table->decimal('anc_amount_paid', 10, 2)->nullable();
            
            // PNC Visits
            $table->date('pnc_visit_1')->nullable();
            $table->date('pnc_visit_2')->nullable();
            
            // Auto-calculated fields
            $table->integer('anc_visits_count')->default(0);
            $table->boolean('anc4_completed')->default(false);
            $table->boolean('pnc_completed')->default(false);
            $table->string('post_edd_followup_status')->nullable();
            $table->string('alert')->nullable();
            
            $table->text('remark')->nullable();
            $table->text('comments')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};