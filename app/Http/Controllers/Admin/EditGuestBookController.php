<?php

namespace App\Http\Controllers\Admin;

use App\GuestBook;
use App\Http\Controllers\Controller;
use App\Http\Requests\GuestMessageRequest;

class EditGuestBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit-posts');
        $this->middleware('can:add-posts');
    }

    public function index()
    {
        $guest_messages = GuestBook::orderBy('created_at', 'desc')->paginate(3);
        return view('admin.editGuestBook', [
            'messages' => $guest_messages
        ]);
    }

    public function update(GuestMessageRequest $request, $id)
    {
        $guest_message = GuestBook::findOrFail($id);
        $guest_message->fill($request->all());

        if(!$guest_message->save()){
            return redirect()->back()->withErrors('Update Error');
        }

        $request->session()->flash('flash_message', 'Message updated');
        return redirect()->route('admin.editGuestBook');
    }

    public function destroy($id)
    {
        $guest_message = GuestBook::findOrFail($id);

        if (!$guest_message->delete()){
            return redirect()->back()->withErrors('Delete Error');
        }

        session()->flash('flash_message', 'Message deleted');
        return redirect()->back();
    }
}
