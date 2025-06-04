<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
   public function create(Request $request)
    {
        $request->validate([

            'contenu' => 'required|string|max:500',
            'id_user' => 'nullable|exists:users,id',
        ]);



        Notification::create([

            'contenu' => $request->contenu,
            'id_user' => $request->id_user ,

        ]);

        return redirect()->back()->with('success', 'Notification créée avec succès');
    }

    /**
     * Afficher le dashboard utilisateur avec ses notifications
     */
    public function findByUser()
    {
        $notifications = Notification::where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $count = $notifications->where('estLu', false)->count();

        return view('page.cv',compact('notifications','count'));
    }

    /**
     * Display the specified resource.
     */
    public function show(notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(notification $notification)
    {
        //
    }
}
