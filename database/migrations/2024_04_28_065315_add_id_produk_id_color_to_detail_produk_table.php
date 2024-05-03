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
        Schema::table('detail_produk', function (Blueprint $table) {
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('color_id')->after('produk_id');
            $table->foreign('color_id')->references('id')->on('color')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_produk', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->dropColumn('produk_id');
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
        });
    }
};
