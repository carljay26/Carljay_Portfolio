<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\PageView;
use App\Models\Project;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalViews   = PageView::count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $totalProjects = Project::count();

        // Traffic last 7 days (day labels + counts)
        $days7  = $this->viewsByDay(7);
        $days30 = $this->viewsByDay(30);

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $activeProjects = Project::where('is_visible', true)->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalViews', 'totalMessages', 'unreadMessages',
            'totalProjects', 'days7', 'days30',
            'recentMessages', 'activeProjects'
        ));
    }

    private function viewsByDay(int $days): array
    {
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $data[] = [
                'label' => $date->format($days === 7 ? 'D' : 'M d'),
                'count' => PageView::whereDate('viewed_at', $date)->count(),
            ];
        }
        return $data;
    }
}
