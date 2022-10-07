<?php

namespace Tests\Browser;

use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'admin@gmail.com')
                    ->type('password', 'admin123')
                    ->press('LOG IN')
                    ->assertPathIs('/');
        });
    }
}
