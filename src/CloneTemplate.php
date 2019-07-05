<?php

namespace Decorate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CloneTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clone-template {--yarn}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $injectJson = [
        "@coreui/coreui",
        "@coreui/coreui-plugin-chartjs-custom-tooltips",
        "@coreui/icons",
        "@coreui/vue",
        "flag-icon-css",
        "simple-line-icons",
        "js-cookie",
        "font-awesome",
        "@team-decorate/alcjs",
        "bootstrap-vue",
        "vue-chartjs",
        "chart.js",
        "sass-loader",
        "node-sass"
    ];

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
        $installer = $this->getInstaller();

        $install = implode(' ', $this->getBeforeLoadPackage());

        $path = base_path();

        // install js package
        exec("{$installer} {$install}", $out);

        // clone template
        exec("cd $path && ". 'git clone https://github.com/decorate/vue-admin-coreui.git', $out);

        File::move(base_path('vue-admin-coreui/src'), resource_path('vue-admin'));
        File::deleteDirectory(base_path('vue-admin-coreui'));
    }

    private function getInstaller() {
        return $this->option('yarn') ? 'yarn' : 'npm install';
    }

    private function getBeforeLoadPackage() {
        try {
            $json = File::get(base_path('package.json'));
            $json = json_decode($json);

            return collect($this->injectJson)
                ->filter(function($x) use($json) {
                    return !property_exists($json->dependencies, $x) &&
                        !property_exists($json->devDependencies, $x);
                })
                ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }
}
