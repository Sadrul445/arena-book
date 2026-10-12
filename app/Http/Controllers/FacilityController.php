<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class FacilityController extends Controller
{
    public function index()
     {
        $categories = ServiceCategory::whereHas(
            'facilities',
            function ($query) {
                $query->where('status', true);
            }
        )
            ->with([
                'facilities' => function ($query) {
                    $query->where('status', true)
                        ->orderBy('name');
                },
                'facilities.pricingPeriods' => function ($query) {
                    $query->where('status', true)
                        ->orderBy('priority');
                },
                'facilities.pricingPeriods.pricingRules' =>
                    function ($query) {
                        $query->where('status', true)
                            ->orderBy('duration_minutes');
                    },
            ])
            ->orderBy('name')
            ->get();

        return view(
            'facilities.index',
            compact('categories')
        );
    }
}
