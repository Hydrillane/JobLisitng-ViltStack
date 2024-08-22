<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {

        $filters = $request->only([
            'position',
            'location'
        ]);

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::latest()
                ->filter($filters)
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function show(Listing $listing)
    $lastCreated->append(['days_since_created']);
    {
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }
}
