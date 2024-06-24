<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class CreateEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_an_event_can_be_created(): void
    {
        // array preparacion de datos
        $eventData = [
            'name' => 'Conferencia',
            'featured' => 'meme.png',
            'date' => Carbon::now(),
            'time' => '12:00:00',
            'location' => 'CAMP NOU'
        ];

        // accionar la prueba
        $response = $this->post('/events', $eventData);

        //resultado de la prueba
        $response->assertStatus(302);  //el codigo 302 es para indicar un redirect
        $this->assertDatabaseHas('events', $eventData);
    }
}
