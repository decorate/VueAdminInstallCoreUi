<?php

namespace Decorate;

use Illuminate\Console\Command;

class AdminInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin-install {--yarn}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'vue admin template install from coreui';

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
        $this->call('vendor:publish', [
            '--provider' => '\Decorate\Providers\AdminInstallCoreUiProvider'
        ]);

        if($this->option('yarn')) {
            $this->call('clone-template --yarn');
        }  else {
            $this->call('clone-template');
        }

        $this->call('make:admin-login');
    }

}
