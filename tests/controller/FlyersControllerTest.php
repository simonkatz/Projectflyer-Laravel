<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FlyersControllerTest extends TestCase
{
    /** @test */
    public function it_shows_the_form_to_create_a_new_flyer()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visit('flyers/create')->see('Selling your Home?');
    }
}