use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTriggerToUpdateStock extends Migration
{
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

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_stock_after_order');
    }
}
