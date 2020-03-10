<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $edit = '/event/id/edit';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'start_date' => 'required|after:today',
            'end_date' => 'required|after:today',
            'description' => 'required',
            'place' => 'required',
            'sections' => 'json|nullable'
        ];

        $customMessages = [
            'name.required' => 'O nome do evento é um campo obrigatório.',
            'start_date.required' => 'A data inicial é obrigatória.',
            'end_date.required' => 'A data final é obrigatória.',
            'description.required' => 'A descrição é obrigatória.',
            'place.required' => 'O campo local do evento é obrigatório.',
            'start_date.after' => 'A data inicial é inválida.',
            'end_date.after' => 'A data final é inválida.'
        ];

        $validatedEvent = $request->validate($rules, $customMessages);

        $eventFields = $request->all();

        $eventFields['start_date'] = date("Y-m-d", strtotime($eventFields['start_date']));
        $eventFields['end_date'] = date("Y-m-d", strtotime($eventFields['end_date']));
        $event = Event::create($eventFields);
        
        $response = [
            'message' => 'Evento foi criado com sucesso!',
            'route' => str_replace('id', $event->id, $this->edit)
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('event.edit', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
