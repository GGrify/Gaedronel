<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function acceptReservation(Request $request) {
        $table = DB::table('reservation');
        $idRoom = $request->input('idRoom');
        $price = $request->input('price');
        $customerName = $request->input('name');
        $customerEmail = $request->input('email');
        $customerPhone = $request->input('phone');
        $customerCard = $request->input('card');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');

        $id = $table->insertGetId([
            'idRoom' => $idRoom,
            'price' => $price,
            'customerName' => $customerName,
            'customerEmail' => $customerEmail,
            'customerPhone' => $customerPhone,
            'customerCard' => $customerCard,
            'startReservation' => $dateStart,
            'endReservation' => $dateEnd
        ]);

        return view('success', ['id' => $id]);
    }

    public function booking(Request $request) {
        $room = DB::table('room')->where('id', $request->input('id'))->first();

        return view('booking', ['room' => $room]);
    }

    public function rooms(Request  $request) {
        $type = $request->input('type');
        $capacity = $request->input('capacity');
        $dateStart = $request->input('dateStart');
        $dateEnd = $request->input('dateEnd');
        $rooms = DB::table('room');
        if($type != null) $rooms = $rooms->where('type', $type);
        if($capacity != null) $rooms = $rooms->where('capacity', $capacity);
        $rooms = $rooms->get();

        if(isset($dateEnd, $dateStart)) {
            foreach ($rooms as $room) {
                $rooms = $rooms->reject(function ($room) use ($dateStart, $dateEnd){
                    $reservation = DB::table('reservation')->where('idRoom', $room->id)->get();
                    $available = true;
                    foreach ($reservation as $reserv) {
                        $startReserv = $reserv->startReservation;
                        $endReserv = $reserv->endReservation;
                        if(
                            ($dateStart >= $startReserv && $dateStart <= $endReserv) ||
                            ($dateEnd >= $startReserv && $dateEnd <= $endReserv) ||
                            ($startReserv >= $dateStart && $startReserv <= $dateEnd) ||
                            ($endReserv >= $dateStart && $endReserv <= $dateEnd)
                        ) {
                            $available = false;
                            break;
                        }
                    }
                    return !$available;
                });
            }
            return view('rooms', ['rooms' => $rooms]);
        } else {
            return view('rooms', ['rooms' => $rooms]);
        }
    }
}
