<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller {

    protected function rules() {
        return Contact::rules();
    }

    public function store(Request $request) {
        $request->validate($this->rules());

        $contact = new Contact();
        $contact->fill($request->all());

        if (config('contact.store')) {
            $contact->save();
        }

        if (config('contact.send')) {
            Mail::to(config('contact.address'))->send(new ContactMessage($contact));
        }
    }

}
