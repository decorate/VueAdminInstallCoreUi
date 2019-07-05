<?php
    namespace VueAdminInstallCoreUi\Test;

    class TestCase extends \Orchestra\Testbench\TestCase {

        protected function setUp(): void {
            parent::setUp();

        }

        protected function getPackageProviders ($app)
        {
            return [
                'Decorate\Providers\AdminInstallCoreUiProvider',
            ];
        }

        protected function getPackageAliases ($app)
        {
            return [
            ];
        }
    }