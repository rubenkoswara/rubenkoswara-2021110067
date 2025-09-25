<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->date('tanggal_lahir')->nullable();
                $table->string('alamat')->nullable();
                $table->string('no_telepon')->nullable();
                $table->string('posisi_jabatan')->nullable();
            });
        }

    /**
     * Reverse the migrations.
     */
        public function down()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('tanggal_lahir');
                $table->dropColumn('alamat');
                $table->dropColumn('no_telepon');
                $table->dropColumn('posisi_jabatan');
            });
        }
};
