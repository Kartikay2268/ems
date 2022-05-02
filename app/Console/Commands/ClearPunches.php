<?php

namespace App\Console\Commands;

use App\Http\Models\Attendance;
use Illuminate\Console\Command;

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
