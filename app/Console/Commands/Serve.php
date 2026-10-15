<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Serve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve {--host=127.0.0.1} {--port=8000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application using PHP built-in server (override fallback)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $host = $this->option('host') ?: '127.0.0.1';
        $port = $this->option('port') ?: '8000';

        $this->info("Starting PHP built-in server on {$host}:{$port}");

        $server = file_exists(base_path('server.php'))
            ? base_path('server.php')
            : base_path('vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php');

        chdir(public_path());

        $cmd = sprintf('php -S %s:%s %s', $host, $port, escapeshellarg($server));

        passthru($cmd);

        return 0;
    }
}
