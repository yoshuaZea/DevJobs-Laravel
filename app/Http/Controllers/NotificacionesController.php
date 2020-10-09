<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionesController extends Controller{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request){
        // Notificaciones no leidas por el usuario
        // $notificacionesNoLeidas = auth()->user()->unreadNotifications;

        // Notificaciones del usuario
        $notificaciones = auth()->user()
                                ->notifications()
                                ->orderBy('created_at', 'desc')
                                ->orderBy('read_at', 'desc')
                                ->simplePaginate(15);

        // Marcar notificaciones leídas
        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.index', compact('notificaciones'));
    }
}
