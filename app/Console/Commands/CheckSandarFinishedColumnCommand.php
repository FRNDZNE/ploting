<?php

namespace App\Console\Commands;

use App\Events\KapalEvent;
use App\Models\Sandar;
use Illuminate\Console\Command;

class CheckSandarFinishedColumnCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sandar:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $finished = Sandar::where('finish', '<=', now())
            ->where('finished', 0)
            ->count();

        $this->info("Finished : $finished");

        if ($finished > 0) {
            Sandar::where('finish', '<=', now())
                ->where('finished', 0)
                ->update([
                    'finished' => 1
                ]);

            
        }
    }
}
