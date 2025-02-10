<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanDownloadsFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-downloads-folder {--hours=1} {--path=app/public/downloads}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans the downloads folder';

    protected int $hours = 1;

    protected string $path = 'app/public/downloads';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->option('hours') ?? $this->hours = 1;
        $this->option('path') ?? $this->path = 'app/public/downloads';

        if ($this->hours < 1) {
            $this->error('Hours must be at least 1.');

            return;
        }

        // Get the path from the argument
        $path = storage_path($this->path);

        // Check if the directory exists
        if (! File::exists($path)) {
            $this->error("Directory not found: $path");

            return;
        }

        // Get all files in the directory
        $files = File::files($path);

        // Calculate the cutoff time (1 hour ago)
        $cutoffTime = Carbon::now()->subHours($this->hours);

        // Loop through the files and remove those older
        foreach ($files as $file) {
            // If the file's last modified time is older than the cutoff time
            if (Carbon::createFromTimestamp($file->getMTime())->lessThan($cutoffTime)) {
                File::delete($file);
                $this->info("Deleted: {$file->getFilename()}");
            }
        }

        $this->info('Old files removed successfully.');
    }
}
