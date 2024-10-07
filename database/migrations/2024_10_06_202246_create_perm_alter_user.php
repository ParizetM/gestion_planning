<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->timestamps();
        });
        Permission::factory()->create(['nom' => 'admin']);
        Permission::factory()->create(['nom' => 'salarie']);
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('permission_id')->default(2)->constrained('permissions');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropColumn('permission_id');
        });
        Schema::dropIfExists('permissions');
    }
};
