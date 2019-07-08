<?php

namespace Decorate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AdminInstallRollback extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin-install:rollback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'vue admin template install from coreui rollback';

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
        $path = app_path('/Http/Controllers/Admin');
        $this->deleteDir($path);

        $path = app_path('/Models/Admin.php');
        $this->delete($path);

        $path = database_path('/migrations/2019_06_04_081438_create_admins_table.php');
        $this->delete($path);

        $path = base_path('/routes/admin.php');
        $this->delete($path);

        $path = resource_path('/vue-admin');
        $this->deleteDir($path);

        $path = database_path('/factories/AdminFactory.php');
        $this->delete($path);

        $path = database_path('/seeds/AdminsSeeder.php');
        $this->delete($path);
    }

    private function delete($path) {
        if(File::exists($path)) {
            File::delete($path);
        }
    }

    private function deleteDir($path) {
        if(File::isDirectory($path)) {
            File::deleteDirectory($path);
        }
    }
}