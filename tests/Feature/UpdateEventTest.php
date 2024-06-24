<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Carbon;

class UpdateEventTest extends TestCase
{
    use RefreshDatabase;
    
    protected $event;

    /*esta funcion se va a ejecutar antes de cada prueba por lo que vamos a
     preparar el evento a actualizar*/
    public function setUp(): void
    {
        /*esto es super necesario ya que se encarga de la inicializacion
        de la base de datos, de las migraciones, si no se llama salataran errores
        en las pruebas ya que configuraciones importantes no se realizaran*/
        parent::setUp();

        //crear evento:
        $this->event = Event::create([
            'name' => 'Conferencia',
            'featured' => 'meme.png',
            'date' => Carbon::now(),
            'time' => '12:00:00',
            'location' => 'CAMP NOU'
        ]);
    }

    public function test_an_event_can_be_updated(): void
    {
        //array que va a actualizar los datos
        $updateData = [
            'name' => 'Conferencia actualizada' 
        ];

        /*act, en la accion lo pirmero que haremos sera mandar 
        el id del evento creado y almacenado en la variable protegida $event,
        despues le mandarmeos la data que queremos actualizar que preparamos 
        en el array updateData*/
        $response = $this->put('/events/'. $this->event->id, $updateData);
        //                   ruta en donde actualizara       variable que almacena los datos que se actualizaran

        //resultado de la prueba
        $response->assertStatus(200); //codigo 200 indica que la actualizacion fue exitosa
        $this->assertDatabaseHas('events', $updateData);
        //                nombre de la tabla    contenido que buscará en la tabla
    }
}
