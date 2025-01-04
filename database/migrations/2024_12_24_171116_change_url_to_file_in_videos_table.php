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
        Schema::table('videos', function (Blueprint $table) {
            $table->renameColumn('url', 'file');
            $table->renameColumn('name', 'full_name');
            $table->text('email')->change();
            $table->integer('age')->after('name')->nullable();
            $table->dropColumn('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->renameColumn('file', 'url');
            $table->renameColumn('full_name', 'name');
            $table->string('email')->change();
            $table->dropColumn('age');
            $table->string('password')->after('email');
        });
    }
};
