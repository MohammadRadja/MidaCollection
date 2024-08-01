<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerToUpdateStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_stock_after_order
            AFTER INSERT ON orders
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock - NEW.count
                WHERE id = NEW.product_id;
            END
        ');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_stock_after_order');
    }
};
