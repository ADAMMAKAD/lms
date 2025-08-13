<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\View\View;

use Modules\PaymentWithdraw\app\Models\WithdrawRequest;

class InstructorDashboardController extends Controller
{
    public function index(): View
    {
        $totalCourses = Course::where('instructor_id', userAuth()->id)->count();
        $totalPendingCourses = Course::where('instructor_id', userAuth()->id)->where(['status' => 'pending', 'is_approved' => 'pending'])->count();
        $courseIds =  Course::where('instructor_id', userAuth()->id)->pluck('id')->toArray();
        // Order functionality removed - showing course enrollments instead
        $totalOrders = 0; // Disabled - no order system
        $totalPendingOrders = 0; // Disabled - no order system
        $totalWithdraw = WithdrawRequest::where(['user_id' => auth('web')->user()->id, 'status' => 'approved'])->sum('withdraw_amount');
        return view('frontend.instructor-dashboard.index', compact(
            'totalCourses',
            'totalOrders',
            'totalPendingCourses',
            'totalPendingOrders',
            'totalWithdraw'
        ));
    }

    function mySells()
    {
        // Order functionality removed - no sales to display
        $orders = collect(); // Empty collection since no order system

        return view('frontend.instructor-dashboard.my-sells.index', compact('orders'));
    }
}
