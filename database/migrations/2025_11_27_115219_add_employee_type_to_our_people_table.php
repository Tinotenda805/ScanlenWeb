<?php

use App\Models\EmployeeType;
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
        Schema::table('our_people', function (Blueprint $table) {
            $table->foreignIdFor(EmployeeType::class, 'employee_type_id')->nullable()->onDelete('set null')->after('name');
            $table->integer('order')->default(0)->after('status');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('our_people', function (Blueprint $table) {
            $table->dropColumn('employee_type_id');
            $table->dropColumn('deleted_at');
        });
    }
};
