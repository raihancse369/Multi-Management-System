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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->integer('setting')->default(0)->nullable();
            $table->integer('page')->default(0)->nullable();
            $table->integer('category')->default(0)->nullable();
            $table->integer('product')->default(0)->nullable();
            $table->integer('offer')->default(0)->nullable();
            $table->integer('orders')->default(0)->nullable();
            $table->integer('message')->default(0)->nullable();
            $table->integer('blog')->default(0)->nullable();
            $table->integer('hrm')->default(0)->nullable();
            $table->integer('attendance')->default(0)->nullable();
            $table->integer('expense')->default(0)->nullable();
            $table->integer('role')->default(0)->nullable();
            $table->integer('type')->default(0)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
