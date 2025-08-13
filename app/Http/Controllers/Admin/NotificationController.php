<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\ContactMessage\app\Models\ContactMessage;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Get admin notifications
     */
    public function getNotifications()
    {
        $notifications = [];
        
        // Get recent contact messages (last 7 days)
        $recentContacts = ContactMessage::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        foreach ($recentContacts as $contact) {
            $notifications[] = [
                'id' => 'contact_' . $contact->id,
                'type' => 'contact',
                'icon' => 'fas fa-envelope',
                'title' => 'New Contact Message',
                'message' => 'From: ' . $contact->name,
                'time' => $contact->created_at->diffForHumans(),
                'url' => route('admin.contact-message'),
                'read' => false
            ];
        }
        
        // Get recent user registrations (last 7 days)
        $recentUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
            
        foreach ($recentUsers as $user) {
            $notifications[] = [
                'id' => 'user_' . $user->id,
                'type' => 'user',
                'icon' => 'fas fa-user-plus',
                'title' => 'New User Registration',
                'message' => $user->name . ' joined as ' . ucfirst($user->role),
                'time' => $user->created_at->diffForHumans(),
                'url' => $user->role === 'instructor' ? route('admin.instructor-list') : route('admin.customer-list'),
                'read' => false
            ];
        }
        
        // Get recent courses (last 7 days)
        $recentCourses = Course::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
            
        foreach ($recentCourses as $course) {
            $notifications[] = [
                'id' => 'course_' . $course->id,
                'type' => 'course',
                'icon' => 'fas fa-book',
                'title' => 'New Course Created',
                'message' => $course->title,
                'time' => $course->created_at->diffForHumans(),
                'url' => route('admin.course.index'),
                'read' => false
            ];
        }
        
        // Sort notifications by time
        usort($notifications, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        // Limit to 5 most recent
        $notifications = array_slice($notifications, 0, 5);
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => count($notifications)
        ]);
    }
    
    /**
     * Mark notification as read
     */
    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');
        
        // Store read notifications in cache for 30 days
        $readNotifications = Cache::get('admin_read_notifications', []);
        $readNotifications[] = $notificationId;
        Cache::put('admin_read_notifications', $readNotifications, 60 * 24 * 30);
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        // Clear the cache to mark all as read
        Cache::forget('admin_read_notifications');
        
        return response()->json(['success' => true]);
    }
}