<?php

namespace App\Schedule;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class EventScheduler
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->call(function () {
            try {
                // Log::info('[Scheduler] Memulai pengecekan status Coming Soon');

                $expiredAt = Carbon::now()->subMinutes(30);

                $affected = Event::where('status', 'Coming Soon')
                    ->where('date', '<', $expiredAt)
                    ->update(['status' => 'Completed']);

                Log::info("[Scheduler] $affected orders diubah menjadi Completed pada " . now());

            } catch (\Throwable $e) {
                Log::error('[Scheduler] Gagal: ' . $e->getMessage());
            }
        })->everyMinute();
    }
}
