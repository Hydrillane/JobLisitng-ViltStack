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
            'location',
        ]);
        $totalCount = Listing::count();

        return inertia('Listing/Index', [
            'filters' => $filters,
            'totalCount' => $totalCount,
            'listings' => Listing::latest()
                ->filter($filters)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function show(Listing $listing)
    {
        $listing->load('owner');
        $listing->append(['days_since_created', 'days_since_updated', 'formatted_salary_range']);

        return inertia('Listing/Show', [
            'listing' => $listing,
        ]);
    }
}
