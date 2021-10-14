<?php

namespace App\Console\Commands;

use App\Repositories\OrderRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateOrdersTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $orderRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepository)
    {
        parent::__construct();
        $this->orderRepository = $orderRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "RUNNING...\n";
        try {
            $orders = $this->orderRepository->all();
            $orders->each(function ($order) {
                if ($order->member_id) {
                    tap($order)->update([
                        'name' => $order->member->account->name ?? '',
                        'address' => $order->member->address ?? '',
                        'phone_number' => $order->member->account->phone_number ?? '',
                        'email' => $order->member->account->email
                    ]);
                }
                if ($order->customer_id) {
                    tap($order)->update([
                        'name' => $order->customer->name ?? '',
                        'address' => $order->customer->address ?? '',
                        'phone_number' => $order->customer->phone_number ?? '',
                        'email' => $order->customer->email
                    ]);
                }
            });
            echo "FINISH!\n";
        } catch (\Exception $e) {
            echo "Has errors!\n";
            Log::error($e);
        }
    }
}
