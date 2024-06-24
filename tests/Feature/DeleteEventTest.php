<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class DeleteEventTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_delete_event(): void
    {
        // preparacion del array
        $event = Event::create([
            'name' => 'Conferencia',
            'featured' => 'meme.png',
            'date' => Carbon::now(),
            'time' => '12:00:00',
            'location' => 'CAMP NOU'
        ]);

        //act
        $response = $this->delete('/events/'. $event->id);

        //res
        $response->assertStatus(204);
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
        //            nombre tabla              campo que se buscara y el id que va a buscar en la base de datos
    }
}
