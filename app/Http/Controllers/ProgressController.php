<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', '6 months');

        $chartData = [
            '3 months' => [
                'values' => [67, 76, 82],
                'labels' => ['Mar', 'Apr', 'May'],
            ],
            '6 months' => [
                'values' => [58, 62, 67, 71, 76, 82],
                'labels' => ['Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'],
            ],
            '12 months' => [
                'values' => [45, 50, 52, 55, 58, 60, 62, 65, 67, 71, 76, 82],
                'labels' => ['Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'],
            ],
        ];

        $currentChart = $chartData[$period] ?? $chartData['6 months'];

        return view('progress', compact('period', 'currentChart'));
    }
}
