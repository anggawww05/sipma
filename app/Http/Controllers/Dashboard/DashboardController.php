<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    // menampilkan halaman dashboard
    public function index(Request $request): View
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = $request->year ?? Carbon::now()->year;

        $submissionYear = [];
        $submissionMonth = [];

        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];
        $weeks = [
            'Minggu 1' => [Carbon::create($currentYear, $currentMonth, 1), Carbon::create($currentYear, $currentMonth, 7)],
            'Minggu 2' => [Carbon::create($currentYear, $currentMonth, 8), Carbon::create($currentYear, $currentMonth, 14)],
            'Minggu 3' => [Carbon::create($currentYear, $currentMonth, 15), Carbon::create($currentYear, $currentMonth, 21)],
            'Minggu 4' => [Carbon::create($currentYear, $currentMonth, 22), Carbon::create($currentYear, $currentMonth, Carbon::create($currentYear, $currentMonth)->endOfMonth()->day)],
        ];

        $years = Submission::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $submissionYearValue = Submission::with('category')->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->when(auth()->user()->operator, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('name', auth()->user()->operator->type);
                });
            })
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        foreach ($months as $monthNumber => $monthName) {
            $submissionYear[$monthName] = $submissionYearValue[$monthNumber] ?? 0;
        }

        foreach ($weeks as $label => [$start, $end]) {
            $count = Submission::whereBetween('created_at', [$start->startOfDay(), $end->endOfDay()])->count();
            $submissionMonth[$label] = $count;
        }

        $submissionCategory = Category::withCount(['submissions' => function ($query) use ($currentYear) {
            $query->whereYear('created_at', $currentYear);
        }
        ])->get()
            ->mapWithKeys(function ($category) {
                return [$category->name => $category->submissions_count];
            });

        $totalStudent = User::whereNotNull('student_id')->whereYear('created_at', $currentYear)->count();
        $totalAdmin = User::whereNotNull('admin_id')->whereYear('created_at', $currentYear)->count();
        $totalOperator = User::whereNotNull('operator_id')->whereYear('created_at', $currentYear)->count();

        $totalSubmission = Submission::whereYear('created_at', $currentYear)->when(auth()->user()->operator, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('name', auth()->user()->operator->type);
                });
            })->count();
        $totalSubmissionApproved = Submission::where('status', 'approved')->whereYear('created_at', $currentYear)->when(auth()->user()->operator, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('name', auth()->user()->operator->type);
                });
            })->count();
        $totalSubmissionRejected = Submission::where('status', 'rejected')->whereYear('created_at', $currentYear)->when(auth()->user()->operator, function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->where('name', auth()->user()->operator->type);
                });
            })->count();

        // Submission per bulan per status
        $submissionByStatusPerMonth = Submission::selectRaw('MONTH(created_at) as month, status, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'), 'status')
            ->get();

        $submissionStatusPerMonth = [];
        foreach ($months as $monthNumber => $monthName) {
            $submissionStatusPerMonth[$monthName] = [
                'approved' => 0,
                'rejected' => 0,
                'pending' => 0,
            ];
        }

        foreach ($submissionByStatusPerMonth as $row) {
            $monthName = $months[$row->month];
            $submissionStatusPerMonth[$monthName][$row->status] = $row->total;
        }

        $userByMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $userPerMonth = [];
        foreach ($months as $monthNumber => $monthName) {
            $userPerMonth[$monthName] = $userByMonth[$monthNumber] ?? 0;
        }

        return view('dashboard.index', [
            'title' => 'Halaman Dashboard',
            'submission_year' => $submissionYear,
            'submission_month' => $submissionMonth,
            'submission_category' => $submissionCategory,
            'categories' => Category::all(),

            'total_student' => $totalStudent,
            'total_admin' => $totalAdmin,
            'total_operator' => $totalOperator,

            'total_submission' => $totalSubmission,
            'total_submission_approved' => $totalSubmissionApproved,
            'total_submission_rejected' => $totalSubmissionRejected,

            'submission_status_per_month' => $submissionStatusPerMonth,
            'user_per_month' => $userPerMonth,

            'years' => $years,
            'current_year' => $currentYear,
        ]);
    }
}
