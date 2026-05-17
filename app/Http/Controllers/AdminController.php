<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function check(): void
    {
        abort_unless(Auth::check() && Auth::user()->isAdmin(), 403);
    }

    public function dashboard()
    {
        $this->check();

        $users = User::where('role', 'user')->count();
        $pendingReports = Report::where('status', 'pending')->count();

        $paidOrders = Order::where('status', 'paid');
        $todayTransactions = (clone $paidOrders)->whereDate('paid_at', today())->count();
        $todayAdminFee = (clone $paidOrders)->whereDate('paid_at', today())->sum('admin_fee');
        $last30Transactions = (clone $paidOrders)->where('paid_at', '>=', now()->subDays(30))->count();
        $last30AdminFee = (clone $paidOrders)->where('paid_at', '>=', now()->subDays(30))->sum('admin_fee');
        $totalTransactions = (clone $paidOrders)->count();
        $totalAdminFee = (clone $paidOrders)->sum('admin_fee');

        return view('admin.dashboard', compact(
            'users',
            'pendingReports',
            'todayTransactions',
            'todayAdminFee',
            'last30Transactions',
            'last30AdminFee',
            'totalTransactions',
            'totalAdminFee'
        ));
    }

    public function users(Request $request)
    {
        $this->check();

        $status = $request->query('status', 'all');
        $q = trim((string) $request->query('q', ''));

        $base = User::where('role', 'user');
        $totalUsers = (clone $base)->count();
        $activeUsers = (clone $base)->where('status', 'active')->count();
        $bannedUsers = (clone $base)->where('status', 'banned')->count();

        $query = User::where('role', 'user');

        if (in_array($status, ['active', 'banned'], true)) {
            $query->where('status', $status);
        }

        if ($q !== '') {
            $query->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $users = $query->latest()->get();

        return view('admin.users', compact('users', 'totalUsers', 'activeUsers', 'bannedUsers', 'status', 'q'));
    }

    public function ban(User $user)
    {
        $this->check();

        $user->update(['status' => $user->status === 'banned' ? 'active' : 'banned']);

        $message = $user->status === 'banned'
            ? 'User berhasil diblokir.'
            : 'User berhasil diaktifkan kembali.';

        return back()->with('success', $message);
    }

    public function reports(Request $request)
    {
        $this->check();

        $status = $request->query('status', 'all');
        $q = trim((string) $request->query('q', ''));

        $base = Report::query();
        $totalReports = (clone $base)->count();
        $pendingReports = (clone $base)->where('status', 'pending')->count();
        $reviewedReports = (clone $base)->where('status', 'reviewed')->count();
        $resolvedReports = (clone $base)->where('status', 'resolved')->count();

        $query = Report::with('user');

        if (in_array($status, ['pending', 'reviewed', 'resolved'], true)) {
            $query->where('status', $status);
        }

        if ($q !== '') {
            $query->where(function ($query) use ($q) {
                $query->where('guide_name', 'like', "%{$q}%")
                    ->orWhere('guide_phone', 'like', "%{$q}%")
                    ->orWhere('group_link', 'like', "%{$q}%")
                    ->orWhere('destination_name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhereHas('user', function ($userQuery) use ($q) {
                        $userQuery->where('name', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%");
                    });
            });
        }

        $reports = $query->latest()->get();

        return view('admin.reports', compact(
            'reports',
            'totalReports',
            'pendingReports',
            'reviewedReports',
            'resolvedReports',
            'status',
            'q'
        ));
    }

    public function reportUpdate(Request $request, Report $report)
    {
        $this->check();

        $data = $request->validate([
            'status' => ['required', 'in:pending,reviewed,resolved'],
        ]);

        $report->update(['status' => $data['status']]);

        return back()->with('success', 'Status laporan diperbarui.');
    }
}
