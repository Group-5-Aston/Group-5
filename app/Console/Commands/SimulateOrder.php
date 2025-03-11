<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SimulateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Orders:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically update order status after a set time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Order::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(2))
            ->update(['status' => 'dispatched']);
    }
}
