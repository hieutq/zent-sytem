<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Log demo';

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
        \Log::info('Hello world');
    }
}
