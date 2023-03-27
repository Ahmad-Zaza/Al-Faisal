<?php

namespace App\Http\Controllers;

use App\Http\Models\Booking;
use App\Rules\ValidRecaptcha;
use crocodicstudio_voila\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'catering_name' => 'string|required',
            'phone_number' => 'string|required',
            'no_of_persons' => '',
            'email' => 'string|required|email',
            'location' => 'string|required',
            'g-recaptcha-response' => ['required', new ValidRecaptcha]
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $booking = Booking::create($request->all());
        $data = [];

        try {
            CRUDBooster::sendEmail(['to' => $request->email, 'data' => $data, 'template' => 'confirmation_tmp', 'attachments' => []]);
        } catch (\Exception $e) {
            Log::log("error", "Send mail $e");
            return redirect()->back()->with('error', 'Error !! Please Check Your Email Address');
        }
        try {
            $data = ["name" => $booking->name, "catering_name" => $booking->catering_name, "phone_number" => $booking->phone_number, "location" => $booking->location, "no_of_persons" => $booking->no_of_persons, "note" => $booking->note];
            CRUDBooster::sendEmail([
                'to' => 'ahmad@voila.digital',
                'data' => $data, 'template' => 'booking_tmp', 'attachments' => []
            ]);
        } catch (\Exception $e) {
            Log::log("error", "Send mail $e");
            return redirect()->back()->with('error', 'Error !! Please Check Your Email Address');
        }
        return redirect()->back()->with('message', 'Done');
    }
}
