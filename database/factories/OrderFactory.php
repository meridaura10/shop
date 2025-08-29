<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(Order::typesList('key'));
        $status = $this->faker->randomElement(Order::statusesList('key'));

        return [
            'status' => $status,
            'type' => $type,
            'customer' => [
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'phone' => $this->faker->phoneNumber(),
                'email' => $this->faker->email(),
            ],
            'address' => $this->faker->address(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
           $products = Product::query()
               ->inRandomOrder()
               ->take(fake()->numberBetween(1,10))
               ->get();

           if ($order->type == Order::TYPE_CART) {
               $userId = User::query()->inRandomOrder()->first()->id;

               if (!Order::query()->where('user_id', $userId)->exists()) {
                   $order->update(['user_id' => $userId]);
               }
           }

           foreach ($products as $product) {
               $order->purchases()->create([
                   'product_id' => $product->id,
                   'name' => $product->name,
                   'price' => $product->price,
                   'quantity' => $this->faker->numberBetween(1, $product->quantity),
               ]);
           }

            $order->update([
                'amount' => $order->purchases->sum('amount'),
            ]);

           if($order->type == Order::TYPE_ORDER){
               $order->payment()->create([
                   'amount' => $order->amount,
               ]);
           }
        });
    }
}
