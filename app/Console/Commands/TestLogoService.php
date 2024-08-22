<?php

namespace App\Console\Commands;

use App\Services\LogoService;
use Illuminate\Console\Command;

class TestLogoService extends Command
{
    protected $signature = 'test:logo-service {count=10}';
    protected $description = 'Test the LogoService';

    public function handle(LogoService $logoService)
    {
        $this->info('Testing LogoService...');

        $count = $this->argument('count');
        $startTime = microtime(true);

        for ($i = 0; $i < $count; $i++) {
            $logoData = $logoService->getRandomLogo();

            if ($logoData && isset($logoData['companyName']) && isset($logoData['logo_url'])) {
                $this->info("Success! Company: {$logoData['companyName']}");
                $this->line("Logo URL: {$logoData['logo_url']}");
            } else {
                $this->error('Failed to get a logo.');
            }

            $this->line('---');
        }

        $endTime = microtime(true);
        $timeTaken = $endTime - $startTime;

        $this->info("Time taken: " . number_format($timeTaken, 2) . " seconds");

        return 0;
    }
}
