<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Handle admin search requests
     */
    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $results = [];
        
        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'results' => []
            ]);
        }
        
        try {
            // Search in different models and add to results
            $results = array_merge(
                $this->searchUsers($query),
                $this->searchCourses($query),
                $this->searchAnnouncements($query),
                $this->searchStaticPages($query)
            );
            
            // Sort results by relevance (exact matches first)
            usort($results, function($a, $b) use ($query) {
                $aExact = stripos($a['title'], $query) === 0 ? 1 : 0;
                $bExact = stripos($b['title'], $query) === 0 ? 1 : 0;
                return $bExact - $aExact;
            });
            
            // Limit results to 8 items
            $results = array_slice($results, 0, 8);
            
            return response()->json([
                'success' => true,
                'results' => $results
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'results' => []
            ], 500);
        }
    }
    
    /**
     * Search users
     */
    private function searchUsers($query)
    {
        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%")
                    ->limit(3)
                    ->get();
        
        $results = [];
        foreach ($users as $user) {
            $results[] = [
                'title' => $user->name,
                'description' => $user->email . ' • ' . ucfirst($user->role ?? 'User'),
                'url' => route('admin.users.show', $user->id),
                'icon' => 'fas fa-user',
                'type' => 'user',
                'badge' => ucfirst($user->role ?? 'User')
            ];
        }
        
        return $results;
    }
    
    /**
     * Search courses
     */
    private function searchCourses($query)
    {
        $courses = Course::where('title', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->limit(3)
                        ->get();
        
        $results = [];
        foreach ($courses as $course) {
            $results[] = [
                'title' => $course->title,
                'description' => 'Course • ' . ($course->instructor->name ?? 'No Instructor'),
                'url' => route('admin.courses.show', $course->id),
                'icon' => 'fas fa-book',
                'type' => 'course',
                'badge' => $course->status ?? 'Draft'
            ];
        }
        
        return $results;
    }
    

    
    /**
     * Search announcements
     */
    private function searchAnnouncements($query)
    {
        $announcements = Announcement::where('title', 'LIKE', "%{$query}%")
                                   ->orWhere('content', 'LIKE', "%{$query}%")
                                   ->limit(2)
                                   ->get();
        
        $results = [];
        foreach ($announcements as $announcement) {
            $results[] = [
                'title' => $announcement->title,
                'description' => 'Announcement • ' . $announcement->created_at->format('M d, Y'),
                'url' => route('admin.announcements.show', $announcement->id),
                'icon' => 'fas fa-bullhorn',
                'type' => 'announcement'
            ];
        }
        
        return $results;
    }
    

    
    /**
     * Search static admin pages
     */
    private function searchStaticPages($query)
    {
        $pages = [
            [
                'title' => 'Dashboard',
                'description' => 'Admin dashboard overview',
                'url' => route('admin.dashboard'),
                'icon' => 'fas fa-tachometer-alt',
                'keywords' => ['dashboard', 'overview', 'stats', 'statistics']
            ],
            [
                'title' => 'Users Management',
                'description' => 'Manage users and permissions',
                'url' => route('admin.users.index'),
                'icon' => 'fas fa-users',
                'keywords' => ['users', 'members', 'accounts', 'permissions']
            ],
            [
                'title' => 'Course Management',
                'description' => 'Manage courses and content',
                'url' => route('admin.courses.index'),
                'icon' => 'fas fa-book',
                'keywords' => ['courses', 'lessons', 'content', 'education']
            ],
            [
                'title' => 'Categories',
                'description' => 'Manage course categories',
                'url' => route('admin.categories.index'),
                'icon' => 'fas fa-tags',
                'keywords' => ['categories', 'tags', 'organization']
            ],
            [
                'title' => 'Announcements',
                'description' => 'Manage site announcements',
                'url' => route('admin.announcements.index'),
                'icon' => 'fas fa-bullhorn',
                'keywords' => ['announcements', 'news', 'updates']
            ],
            [
                'title' => 'Contact Messages',
                'description' => 'View contact form submissions',
                'url' => route('admin.contact-messages.index'),
                'icon' => 'fas fa-envelope',
                'keywords' => ['contact', 'messages', 'support', 'inquiries']
            ],
            [
                'title' => 'Settings',
                'description' => 'System configuration',
                'url' => route('admin.settings'),
                'icon' => 'fas fa-cog',
                'keywords' => ['settings', 'configuration', 'preferences']
            ]
        ];
        
        $results = [];
        foreach ($pages as $page) {
            // Check if query matches title or keywords
            $titleMatch = stripos($page['title'], $query) !== false;
            $keywordMatch = false;
            
            foreach ($page['keywords'] as $keyword) {
                if (stripos($keyword, $query) !== false) {
                    $keywordMatch = true;
                    break;
                }
            }
            
            if ($titleMatch || $keywordMatch) {
                $results[] = [
                    'title' => $page['title'],
                    'description' => $page['description'],
                    'url' => $page['url'],
                    'icon' => $page['icon'],
                    'type' => 'page'
                ];
            }
        }
        
        return $results;
    }
}