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
        Schema::create('cms_group_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_group'); // Foreign key to cms_permission_group
            $table->timestamps();
            $table->foreign('permission_group')
                  ->references('id')
                  ->on('cms_permission_group')
                  ->onDelete('cascade');
            $table->string('permission_name');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_group_permissions');
    }
};
