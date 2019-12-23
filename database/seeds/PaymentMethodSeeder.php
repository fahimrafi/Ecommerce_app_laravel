<?php

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $payment = new Payment();
        $payment->name = "in_cash";
        $payment->priority = 1;
        $payment->short_name = "in_cash";
        $payment->no = NULL;
        $payment->type = NULL;       
        $payment->save();

        $payment = new Payment();
        $payment->name = "bkash";
        $payment->priority = 2;
        $payment->short_name = "bkash";
        $payment->no = "01678620172";
        $payment->type = "Personal";       
        $payment->save();
        
        $payment = new Payment();
        $payment->name = "rocket";
        $payment->priority = 3;
        $payment->short_name = "rocket";
        $payment->no = "016786201729";
        $payment->type = "Personal";       
        $payment->save();
    }
}
