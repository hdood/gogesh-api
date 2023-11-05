<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use stdClass;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notification = Notification::all();
        $notifications = [];
        foreach ($notification as $notif) {
            $not = new stdClass();
            // Access notification properties
            $not->id = $notif->id;
            $not->title = $notif->title;
            $not->content = $notif->content;
            $not->to = $notif->to;
            $not->type = $notif->type;
            // Access related receive model properties (if it exists)
            if ($notif->receive_id) {
                $not->user = $notif->receive;
                // ... other properties of the receive model
            }
            $notifications[] = $not;
        }
        // return $notifications;
        $notifications = json_encode($notifications);
        return view('notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
