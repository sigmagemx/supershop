<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->decimal('total', 10, 2);
            $table->enum('delivery_id', [1, 2, 3]);
            $table->string('comment')->nullable();
            $table->enum('status', ['Ожидает доставки', 'Принят', 'Отгружен', 'У курьера', 'Доставлен', 'Отмена'])->default('Ожидает доставки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
