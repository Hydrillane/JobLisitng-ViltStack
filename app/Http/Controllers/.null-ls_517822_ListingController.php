<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    public function index(Request $request, Listing $listing)
    {
        $query = Listing::query();

        if
        return inertia('Listing/Index', [
            'listings' => Listing::all(),
        ]);
    }

    public function show(Listing $listing)
    {
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }
}
