<?php
namespace VueAdminInstallCoreUi\Test;

class CommandTest extends TestCase {

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @group vue-admin
     */
    function test() {
        $this->artisan('admin-install');
    }
}