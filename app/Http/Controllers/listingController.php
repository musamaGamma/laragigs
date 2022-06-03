<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class listingController extends Controller
{
    //
    public function index(Request $request) {


        return view('listings.index', ['listings' => Listing::latest()->filter(['tag' =>$request->tag, 'search' => $request->search])->paginate(4)]);
    }

    public function show(Listing $listing) {
        return view('listings.show', ['listing' => $listing]);
    }

    public function create() {
        return view('listings.create');
    }

    public function store(Request $request) {
        if($listing->user_id != auth()->id()) {
            abort(403, "unauthorized action");
        }
     $formFields = $request->validate([
         'title' => 'required',
         'company' => ['required', Rule::unique('listings', 'company')],
         'location' => 'required',
         'website' =>  ['required', 'url'],
         'email' => ['required', 'email'],
         'tags' => 'required',
         'description' => 'required'
     ]);

     if($request->hasFile('logo')) {
         $formFields['logo']= $request->file('logo')->store('logos', 'public');
     };
     $formFields['user_id'] = auth()->id();
    Listing::create($formFields);
    return redirect('/')->with('message', 'listing created successfully');
    }

    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update (Request $request,Listing $listing) {
        if($listing->user_id != auth()->id()) {
            abort(403, "unauthorized action");
        }
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' =>  ['required', 'url'],
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo']= $request->file('logo')->store('logos', 'public');
        };


       $listing->update($formFields);

        return redirect("/")->with('message', "listing updated successfully");
    }

    public function destory (Listing $listing) {

        if($listing->user_id != auth()->id()) {
            abort(403, "unauthorized action");
        }
        $listing->delete();
        return redirect('/')->with('message', "listing was deleted successfuly");
    }

    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings]);
    }
}
