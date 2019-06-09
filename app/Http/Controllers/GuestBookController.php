<?php

namespace App\Http\Controllers;

use App\GuestBook;
use App\Http\Requests\GuestMessageRequest;
use Illuminate\Support\Facades\Auth;

class GuestBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guest_messages = GuestBook::orderBy('created_at', 'desc')->paginate(3);
        return view('guestBook', [
            'messages' => $guest_messages
        ]);
    }

    public function store(GuestMessageRequest $request)
    {
        $guest_message = GuestBook::create([
            'message' => $request->get('message'),
            'user_id' => Auth::user()->id
        ]);

        if (!$guest_message){
            return redirect()->back();
        }

        $request->session()->flash('flash_message', 'Message saved');
        return redirect()->route('guestBook');
    }
}

















