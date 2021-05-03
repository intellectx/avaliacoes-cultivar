<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $now = (new DateTimeImmutable())->format('Y-m-d H:i:s');

        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@avaliacoescultivar.com.br',
            'email_verified_at' => $now,
            'remember_token' => Str::random(50),
            'password' => Hash::make($_ENV['APP_ADMIN_PASSWORD']),
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
