<?php

namespace Database\Factories;

use App\Models\UserPrize;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPrizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPrize::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => 1,
            'value'=> $this->faker->numberBetween(10,125),
            'user_id' => $this->faker->randomNumber(3),
            'bank_card' =>$this->faker->randomNumber(8).$this->faker->randomNumber(8),
            'phone_number'=>'380'.$this->faker->randomNumber(9),
            'card_exp_month'=>$this->faker->numberBetween(1,12),
            'card_exp_year'=>$this->faker->numberBetween(1,22),
            'card_cvv'=>$this->faker->randomNumber(3),
            'sent_status'=>0

        ];
    }
}
