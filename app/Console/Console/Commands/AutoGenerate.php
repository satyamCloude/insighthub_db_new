<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PayRollSetting;

class AutoGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-generate';

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
        $PayRollSetting = PayRollSetting::where('id', 1)->first();
        $url = $PayRollSetting->cron_url;

        try {
            // Perform your logic, e.g., make an HTTP request
            $response = Http::get($url);

            $this->info('Command executed successfully.');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
