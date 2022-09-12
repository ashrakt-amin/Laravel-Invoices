<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InvoicesFactory extends Factory
{
   
    public function definition()
    {

        return [
           
                'invoice_number'=>$this->faker->numberBetween(1,10),
                'invoice_date'=>$this->faker->date('Y_m_d'),
                'due_date'=>$this->faker->date('Y_m_d'),
                'product'=>$this->faker->numberBetween(1,10),
                'Amount_collection'=> 50000,
                'Amount_Commission'=>1000,
                'discount'=>100,
                'section_id' =>$this->faker->numberBetween(1,10),
                'rate_vat' =>5,
                'value_vat' =>45,
                'total' =>945,
                'Payment_Date' =>$this->faker->date('Y_m_d'),
                'status' =>"unpaid",
                'value_status' =>0,
                'note' =>$this->faker->text(),
        ];
    }
}
