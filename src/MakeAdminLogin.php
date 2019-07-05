<?php

namespace Decorate;

use Illuminate\Console\Command;

class MakeAdminLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin-login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->call('make:controller', ['name' => 'Admin/LoginController']);
        $path = app_path('Http/Controllers/Admin/LoginController.php');

        \File::put($path, \File::get($this->getStub()));

    }

    public function getStub() {
        return __DIR__ . '/stubs/LoginController.php';
    }
}
