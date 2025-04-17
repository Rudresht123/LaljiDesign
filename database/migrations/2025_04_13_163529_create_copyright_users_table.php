<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('copyright_users', function (Blueprint $table) {
            $table->id();

            // Attorney and Category relationships
            $table->unsignedBigInteger('attorney_id');

            $table->unsignedBigInteger('category_id');


            // Office relationship
            $table->unsignedBigInteger('office_id')->nullable();


            // Trademark-related fields
            $table->bigInteger('application_no')->nullable();
            $table->string('file_name')->nullable();
            $table->string('trademark_name')->nullable();
            $table->unsignedBigInteger('trademark_class')->nullable();
            $table->date('filling_date')->nullable();
            $table->bigInteger('phone_no')->nullable();
            $table->string('email_id')->nullable();
            $table->date('date_of_application')->nullable();
            $table->date('opposition_hearing_date')->nullable();

            // Status and Sub-status relationships
            $table->unsignedBigInteger('status')->nullable();


            $table->unsignedBigInteger('sub_status')->nullable();


            // Remarks relationship
            $table->unsignedBigInteger('remarks')->nullable();

            // Consultant relationship
            $table->unsignedBigInteger('consultant');


            // Dynamic fields (Add the dynamic fields you need)
            $table->date('objected_hearing_date')->nullable();
            $table->string('opponenet_applicant_name')->nullable();
            $table->string('opponent_applicant')->nullable();
            $table->string('opponent_applicant_code')->nullable();
            $table->date('hearing_date')->nullable();
            $table->string('rectification_no')->nullable();
            $table->string('opposed_no')->nullable();
            $table->string('examination_report')->nullable();

            // Deal With relationship
            $table->unsignedBigInteger('deal_with')->nullable();


            // Sub Category relationship
            $table->unsignedBigInteger('sub_category');

            // Validity date and filed by
            $table->date('valid_up_to')->nullable();
            $table->string('filed_by')->nullable();

            // Financial Year relationship
            $table->bigInteger('financial_year');

          

            // Miscellaneous fields
            $table->string('opposition_no')->nullable();
            $table->text('post_hearing_remarks')->nullable();
            $table->string('ip_field')->nullable();
            $table->date('evidence_last_date')->nullable();
            $table->string('email_remarks')->nullable();
            $table->string('client_communication')->nullable();
            $table->date('mail_recived_date')->nullable(); 
            $table->softDeletes();
            $table->timestamps();
            // Only keep one mail received date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copyright_users');
    }
};
