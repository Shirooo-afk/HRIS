<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->date('date_of_birth')->nullable()->after('address');
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete()->after('gender');
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete()->after('department_id');
            $table->string('profile_image')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
            $table->dropColumn(['phone', 'address', 'date_of_birth', 'gender', 'department_id', 'position_id', 'profile_image']);
        });
    }
};
