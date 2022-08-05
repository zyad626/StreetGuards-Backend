<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $lat = 30.272662;
        $lng = 31.393483;
        $zoom =  2;

        $data = [
            'lat' => $lat,
            'lng' => $lng,
            'zoomLevel' => $zoom
        ];
        return view('site.home', $data);
    }

    public function aboutUs()
    {
        return view('site.about_us');
    }


    public function postContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'organization' => 'required',
            'message' => 'required',
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->organization = $request->organization;
        $message->message = $request->message;
        $message->ip = request()->ip();
        $message->save();

        return redirect(route('site.success-contact'));
    }

    public function successContact()
    {
        return view('site.message', [
            'messageTitle' => 'Message Received',
            'message' => 'We received your message and will get in contact with you soon.'
        ]);
    }
}