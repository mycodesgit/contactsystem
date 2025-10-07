<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Contacts;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect()->route('getLogin')->with('success', 'You have been Successfully Logged Out');
    }

    public function store()
    {
        return view ('add');
    }

    public function show(Request $request)
    {
        $search = $request->get('search', '');

        $contacts = Contacts::join('users', 'contacts.postedBy', '=', 'users.id')
            ->where('contacts.contact_name', 'like', "%{$search}%")
            ->orWhere('contacts.contact_company', 'like', "%{$search}%")
            ->orWhere('contacts.contact_phone', 'like', "%{$search}%")
            ->orWhere('contacts.email', 'like', "%{$search}%")
            ->orderBy('contacts.id', 'asc')
            ->paginate(5);

        return response()->json($contacts);
    }


    public function contactCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'contact_name' => 'required'
            ]);

            $contactName = $request->input('contact_name'); 
            $companyName = $request->input('contact_company'); 
            $phoneName = $request->input('contact_phone'); 
            $emailName = $request->input('email'); 

            $existingContact = Contacts::where('contact_name', $contactName)
                        ->where('contact_company', $companyName)
                        ->where('contact_phone', $phoneName)
                        ->where('email', $emailName)
                        ->first();

            if ($existingContact) {
                return response()->json(['error' => true, 'message' => 'Contact already exists!']);
            }

            try {
                Contacts::create([
                    'contact_name' => $request->input('contact_name'),
                    'contact_company' => $request->input('contact_company'),
                    'contact_phone' => $request->input('contact_phone'),
                    'email' => $request->input('email'),
                    'postedBy' => Auth::guard('web')->user()->id,
                ]);

                return redirect()->route('index.contact')->with('success', 'Contact saved successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'Failed to Save Contact!');
            }
        }
    }
    public function editContact($id)
    {
        $contact = Contacts::findOrFail($id);
        return view('edit', compact('contact'));
    }


    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'contact_name' => 'required',
            'contact_company' => 'required',
            'contact_phone' => 'required',
            'email' => 'required|email',
        ]);

        $contact = Contacts::findOrFail($id);
        $contact->update($request->only(['contact_name', 'contact_company', 'contact_phone', 'email']));
        //return response()->json(['success' => true, 'message' => 'Contact updated successfully!']);
        return redirect()->route('index.contact')->with('success', 'Contact updated successfully!');
    }

    public function deleteContact($id)
    {
        $contact = Contacts::find($id);

        if (!$contact) {
            return response()->json(['error' => true, 'message' => 'Contact not found!']);
        }

        $contact->delete();

        return response()->json(['success' => true, 'message' => 'Contact deleted successfully!']);
    }
}
