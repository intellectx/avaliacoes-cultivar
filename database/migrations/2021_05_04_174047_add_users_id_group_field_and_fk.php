<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddUsersIdGroupFieldAndFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable(true)->after('id');
            $table->boolean('active')->nullable(false)->default(true)->after('remember_token');
        });

        $managerGroup = DB::table('groups')
            ->select(['id'])
            ->where(['system_name' => 'MANAGER'])
            ->first();

        DB::table('users')->update(['group_id' => $managerGroup->id]);

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable(false)->change();
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
            $table->dropColumn('active');
        });
    }
}
