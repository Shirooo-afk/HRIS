<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username')->nullable()->after('name');
            });
        }

        $users = DB::table('users')
            ->whereNull('username')
            ->orWhere('username', '')
            ->get();

        foreach ($users as $user) {
            $base = Str::of($user->email)
                ->before('@')
                ->snake('-')
                ->replace(' ', '-');

            $username = $base->value() ?: 'user-' . $user->id;
            $exists = DB::table('users')->where('username', $username)->exists();

            if ($exists) {
                $username .= '-' . $user->id;
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update(['username' => $username]);
        }

        if (!Schema::hasIndex('users', 'users_username_unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('username');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique('users_username_unique');
                $table->dropColumn('username');
            });
        }
    }
};
