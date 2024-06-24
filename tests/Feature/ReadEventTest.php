<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class ReadEventTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_can_read_events_from_database(): void
    {
        // array preparacion de datos
        Event::Create([
            'name' => 'Evento 1',
            'featured' => 'meme.png',
            'date' => Carbon::now(),
            'time' => '12:00:00',
            'location' => 'CAMP NOU'
        ]);

        Event::Create([
            'name' => 'Evento 2',
            'featured' => 'meme.png',
            'date' => Carbon::now(),
            'time' => '12:00:00',
            'location' => 'CAMP NOU'
        ]);

        // act
        $response = $this->get('/events');

        // assert
        $response->assertStatus(200); //el codigo 200 testea que estemos viendo una pagina web

        $response->assertSee('Evento 1'); //comprobamos que dentro de la pagina web existen tanto el evento 1 como el 2
        $response->assertSee('Evento 2');

    }
}
