<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Requests\InviteEventRequest;
use App\Http\Resources\EventResource;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->success(EventResource::collection($this->eventRepository->getPaginatedEvents()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventRequest $eventRequest
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $eventRequest)
    {
        return response()->success(new EventResource(
                $this->eventRepository->createEvent($eventRequest))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->success(
            new EventResource(
                $this->eventRepository->findEventById($id)
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventRequest $eventRequest
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $eventRequest, $id)
    {
        return response()->success(
            new EventResource(
                $this->eventRepository->updateEvent($id, $eventRequest)
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->eventRepository->deleteEvent($id);
        return response()->success([], 'Event deleted');
    }

    public function invite(InviteEventRequest $inviteEventRequest, $id)
    {
        return response()->success($this->eventRepository->invite($id, $inviteEventRequest));
    }
}
