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
        Schema::create('pbs', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('area')->nullable();
            $table->string('born_place')->nullable();
            $table->date('bod')->nullable();
            $table->string('religion')->nullable();
            $table->string('graduate')->nullable();
            $table->string('ktp_address')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->date('join_date')->nullable();
            $table->enum('partner_status', ['active', 'inactive'])->default('active');
            $table->string('ktp_number')->nullable();
            $table->string('kk_number')->nullable();
            $table->string('skck_number')->nullable();
            $table->text('ktp_path_doc')->nullable();
            $table->text('kk_path_doc')->nullable();
            $table->text('skck_path_doc')->nullable();
            $table->text('selfie_path')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('deleted_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pbs');
    }
};
