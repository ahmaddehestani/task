<?php

namespace App\Http\Controllers\V1;

use App\Actions\Event\StoreEventAction;
use App\Http\Controllers\BaseApiController;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Repositories\Event\EventRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EventController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, EventRepositoryInterface $repository): JsonResponse
    {

        $events = Cache::rememberForever('events', function () use ($repository, $request) {
            return $repository->paginate($request->input('page_limit'), $request->all());
        });
        return $this->resultWithAdditional(EventResource::collection($events),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Event::class),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $event=StoreEventAction::run($request->validated());
        return $this->successResponse(EventResource::make($event));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
