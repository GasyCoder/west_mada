<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Console\Command;

class MyScheduledTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string  
     */
    protected $signature = 'app:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run disabled a event';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        Event::where('is_active', true)
        ->where('created_at', '<=', Carbon::now())->update(['is_active' => false]);
        info("Event is Disabled");
        return 0;
    }
}
