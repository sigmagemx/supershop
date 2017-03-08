<?php

use Illuminate\Database\Seeder;
use App\Delivery;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::create([
        	'name' => 'Курьерская доставка с оплатой при получении'
        ]);

        Delivery::create([
        	'name' => 'Почта России с наложенным платежом'
        ]);

        Delivery::create([
        	'name' => 'Доставка через терминалы QIWI Post'
        ]);
    }
}
