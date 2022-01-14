<?php


namespace App\Repositories;


use App\Exceptions\ResourceNotFoundException;
use App\Http\Requests\EventRequest;
use App\Http\Requests\InviteEventRequest;
use App\Jobs\InviteEvent;
use App\Models\Event;

class EventRepository
{
    private $eventModel;


    public function __construct(Event $event)
    {
        $this->eventModel = $event;
    }

    public function getPaginatedEvents()
    {
        return $this->getEventModel()->paginate();
    }

    /**
     * @return Event
     */
    public function getEventModel(): Event
    {
        return $this->eventModel;
    }

    public function createEvent(EventRequest $eventRequest)
    {
        return $this->getEventModel()->create(
            array_merge($eventRequest->only([
                'title',
                'description',
                'place',
            ]),
                [
                    'user_id' => $eventRequest->user()->id
                ]
            )
        );
    }


    public function updateEvent($id, EventRequest $eventRequest)
    {
        $event = $this->findEventById($id);

        $event->update($eventRequest->only([
            'title',
            'description',
            'place',
        ]));
        return $event;
    }

    public function deleteEvent($id)
    {
        $event = $this->findEventById($id);
        $event->delete($id);
    }

    /**
     * Get event by Id
     * @param int $id
     * @return mixed
     * @throws ResourceNotFoundException
     */
    public function findEventById(int $id)
    {
        $event = $this->getEventModel()->find($id);
        if (is_null($event)) {
            throw new ResourceNotFoundException("Event #{$id} not found");
        }
        return $event;
    }

    public function invite($id, InviteEventRequest $inviteEventRequest)
    {
        $event = $this->findEventById($id);
        return InviteEvent::dispatch($event, $inviteEventRequest->get('emails'));
        return true;
    }
}
