<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WebScraperService;

class RefreshWebsiteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sena:refresh-data 
                           {--clear-cache : Clear cached data before refresh}
                           {--deep-crawl : Perform deep crawling of all pages}
                           {--schedule : Run as scheduled task}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh PT SENA website data for chatbot with enhanced deep crawling capabilities';

    /**
     * Execute the console command.
     */
    public function handle(WebScraperService $webScraperService)
    {
        $this->info('🔄 Starting Enhanced PT SENA website data refresh...');

        if ($this->option('clear-cache')) {
            $this->info('🗑️ Clearing all cached data...');
            $webScraperService->clearCache();
            $this->comment('Cache cleared successfully.');
        }

        $this->info('📡 Fetching fresh data from https://new.pt-sena.co.id...');

        try {
            $startTime = microtime(true);

            // Get basic data
            $this->info('📊 Fetching basic company data...');
            $data = $webScraperService->getAllData();

            $this->displayResults($data);

            if ($this->option('deep-crawl')) {
                $this->info('🕷️ Performing deep crawling...');
                $deepContent = $webScraperService->getDeepWebsiteContent();
                $this->info('✅ Deep crawling completed: ' . count($deepContent) . ' pages analyzed');

                $siteStructure = $webScraperService->mapSiteStructure();
                $this->info('🗺️ Site structure mapped: ' . $siteStructure['total_pages_discovered'] . ' pages discovered');
            }

            $endTime = microtime(true);
            $executionTime = round(($endTime - $startTime), 2);

            $this->info("⚡ Data refresh completed in {$executionTime} seconds");

            if ($this->option('schedule')) {
                $this->comment('📅 Scheduled refresh completed at ' . now()->format('Y-m-d H:i:s'));
            }

            $this->success('🎉 PT SENA website data successfully refreshed!');
            $this->newLine();
            $this->info('💡 AI chatbot now has access to the latest website information.');
        } catch (\Exception $e) {
            $this->error('❌ Error refreshing data: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * Display refresh results
     */
    private function displayResults($data)
    {
        $this->newLine();
        $this->info('📈 REFRESH RESULTS:');
        $this->info('==================');

        // Company info
        if (!empty($data['company']['name'])) {
            $this->line("✅ Company Info: {$data['company']['name']} (Est. {$data['company']['established']})");
        }

        // Capabilities
        if (!empty($data['capabilities'])) {
            $this->line("✅ Capabilities: " . count($data['capabilities']) . " services found");
        }

        // News
        if (!empty($data['news'])) {
            $this->line("✅ Latest News: " . count($data['news']) . " articles found");
            $latestNews = reset($data['news']);
            if ($latestNews) {
                $this->comment("   Latest: {$latestNews['title']} ({$latestNews['date']})");
            }
        }

        // Experiences
        if (!empty($data['experiences'])) {
            $this->line("✅ Project Experiences: " . count($data['experiences']) . " projects found");
        }

        // Contact
        if (!empty($data['contact']['phone'])) {
            $this->line("✅ Contact Info: {$data['contact']['phone']}");
        }

        // Investor info
        if (!empty($data['investor_info'])) {
            $this->line("✅ Investor Information: Available");
        }

        // Annual reports
        if (!empty($data['annual_reports'])) {
            $this->line("✅ Annual Reports: " . count($data['annual_reports']) . " reports found");
        }

        // Deep content
        if (!empty($data['deep_content'])) {
            $this->line("✅ Deep Content: " . count($data['deep_content']) . " pages analyzed");
        }

        $this->line("🕐 Last Updated: {$data['last_updated']}");
        $this->newLine();
    }

    /**
     * Display success message
     */
    private function success($message)
    {
        $this->getOutput()->writeln("<bg=green;fg=white> SUCCESS </> {$message}");
    }
}
