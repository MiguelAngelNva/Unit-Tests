<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Tests\Feature\UpdateEventTest;

class EventController extends Controller
{

    /* como ya tenemos los datos del request en el archivo StoreEventRequest,
        ya no necesitaremos el REQUEST sino que en su lugar utilizaremos 
        los datos llegados del storeEventRequest
    */

    /*Como esperamos que este metodo con retorne o nos redirija a otra ruta
    colocamos el redirectResponse para especificar que esramos que el metodo
    nos retorne el redirect*/
    public function store(StoreEventRequest $request): RedirectResponse
    {

        $evenData = $request->all();

        /*Este codigo ya no se utilizara ya que al almacenar en el $request
        lo que tenemos en el StoreEventRequest seria lo mismo, pero hacer que
        el mantenimiento del codigo sea mucho mas sencillo */ 

        // $evenData = $request->validate([
        //     "name" => 'required|string|max:60',
        //     "featured" => 'required|string|max:50',
        //     "date" => 'required|date',
        //     "time" => 'required|date_format:H:i:s',
        //     "location" => 'required|string|max:60'
        // ]);


        Event::create($evenData);

        return redirect()->route('events.index');
    }

    // vamos a definir que una funcion es para mostrar una vista mediante un :view enfrente de la funcion
    public function index(Request $request): View 
    {
        $events = Event::get();
        return view('events.index')->with(compact('events'));
    }

    public function update(UpdateEventRequest $request, $id)
    {
        
        $event = Event::where('id', $id)->first();

        //utilizamos el validate ya que el validate devuelve solo los datos que han pasado la validación según las reglas definidas en tu clase de request
        $event->update($request->validated());

        return response()->json($event, 200);
        //devolvemos el event con la actualizacion y el status 200 que indica que salio bien
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Event::where('id', $id)->delete();

        return response(null, 204); // respuesta sin contenido
    }
}
