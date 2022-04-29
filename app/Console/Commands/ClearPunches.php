<?php

namespace App\Console\Commands;

use App\Attendance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ClearPunches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:punches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the punch in/out times to null';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            Attendance::clearPunchTimes();
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
        }

    }
}
