<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('display_name')->nullable()->after('username');
            $table->string('avatar_path')->nullable()->after('display_name');
            $table->string('title')->nullable()->after('avatar_path');
            $table->text('bio')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'display_name', 'avatar_path', 'title', 'bio']);
        });
    }
};
