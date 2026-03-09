<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('borrowers', function (Blueprint $table) {
            //
            $table->time('time_borrowed')->change();
            $table->time(column: 'time_return')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowers', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->string('time_borrowed')->change();
            $table->string('time_return')->change();
        });
    }
};
