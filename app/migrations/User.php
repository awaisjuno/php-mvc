<?php

use System\Database\Schema;

class User
{
    public function up()
    {
        Schema::table('table_name', function($table) {
            $table->int('id', true);
            $table->string('first_name');
            $table->string('last_name');
        });
    }

    public function down()
    {
        // Add rollback logic here
    }
}
