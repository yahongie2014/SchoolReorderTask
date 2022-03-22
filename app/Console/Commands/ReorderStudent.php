<?php

namespace App\Console\Commands;

use App\Http\Controllers\HomeController;
use Illuminate\Console\Command;

class ReorderStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reorder:student';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reorganize Student On School ID';

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
     * @return int
     */
    public function handle()
    {
        $controller = new HomeController();
        $result = $controller->ReorderStudent();
        $this->info($result);
    }
}
