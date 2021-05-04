<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->nullable(false);
            $table->enum('system_name', ['ADMIN', 'MANAGER', 'SCHOOL', 'TEACHER'])->nullable(true);
            $table->boolean('active')->nullable(false)->default(true);
            $table->timestamps();
        });

        $now = (new DateTimeImmutable())->format('Y-m-d H:i:s');

        DB::table('groups')->insert([
            'name' => 'Administrador(a)',
            'system_name' => 'ADMIN',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('groups')->insert([
            'name' => 'Gestor(a) Público',
            'system_name' => 'MANAGER',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('groups')->insert([
            'name' => 'Escola',
            'system_name' => 'SCHOOL',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('groups')->insert([
            'name' => 'Professor(a)',
            'system_name' => 'TEACHER',
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
        Schema::dropIfExists('groups');
    }
}
