<?php

use App\Models\Expertise;
use App\Models\OurPeople;
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
        Schema::create('our_people_expertises', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OurPeople::class, 'person_id');
            $table->foreignIdFor(Expertise::class, 'expertise_id');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_people_expertises');
    }
};
