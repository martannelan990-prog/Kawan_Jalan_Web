<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Destination;
use App\Models\Favorite;
use App\Models\NotificationItem;
use App\Models\Order;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function home()
    {
        $cities = City::withCount('destinations')->whereNotIn('slug', ['jakarta', 'lembang'])->get();

        $popular = Destination::with('city')
            ->where('is_popular', true)
            ->whereHas('city', fn ($query) => $query->whereNotIn('slug', ['jakarta', 'lembang']))
            ->take(6)
            ->get();

        $recommended = Destination::with('city')
            ->where('is_recommended', true)
            ->whereHas('city', fn ($query) => $query->whereNotIn('slug', ['jakarta', 'lembang']))
            ->take(6)
            ->get();

        if ($recommended->isEmpty()) {
            $recommended = Destination::with('city')->take(6)->get();
        }

        $notificationCount = Auth::check()
            ? NotificationItem::where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', Auth::id());
            })->where('is_read', false)->count()
            : 0;

        return view('home', compact('cities', 'popular', 'recommended', 'notificationCount'));
    }

    public function search()
    {
        $cities = City::whereNotIn('slug', ['jakarta', 'lembang'])->get();

        return view('search', compact('cities'));
    }

    public function city($slug)
    {
        return $this->cityShow($slug);
    }

    public function cityShow($slug)
    {
        $city = City::where('slug', $slug)
            ->whereNotIn('slug', ['jakarta', 'lembang'])
            ->with('destinations')
            ->firstOrFail();

        if ($city->slug === 'sukabumi') {
            return view('destinations.coming-soon', compact('city'));
        }

        return view('destinations.city', compact('city'));
    }

    public function favorite()
    {
        $favorites = Auth::user()
            ->favorites()
            ->with('city')
            ->get();

        return view('favorite', compact('favorites'));
    }

    public function toggleFavorite(Destination $destination)
    {
        $user = Auth::user();
        $user->favorites()->toggle($destination->id);

        return back()->with('success', 'Favorit diperbarui.');
    }

    public function schedule()
    {
        $orders = Auth::user()
            ->orders()
            ->with('destination.city')
            ->where('status', 'paid')
            ->latest()
            ->get()
            ->filter(fn ($order) => $order->isTicketValid())
            ->values();

        return view('schedule', compact('orders'));
    }

    public function notifications()
    {
        $items = NotificationItem::where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id', Auth::id());
            })
            ->latest()
            ->get();

        NotificationItem::where('user_id', Auth::id())->update(['is_read' => true]);

        return view('notifications', compact('items'));
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function editProfile()
    {
        return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'regex:/^08[0-9]{8,13}$/'],
            'country' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi gaboleh kosong.',
            'email.required' => 'Email wajib diisi gaboleh kosong.',
            'email.email' => 'Email wajib menggunakan tanda @.',
            'phone.required' => 'Nomor telepon wajib diisi gaboleh kosong.',
            'phone.regex' => 'Nomor telepon wajib diawali 08.',
        ]);

        Auth::user()->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function password()
    {
        return view('profile.password');
    }


    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'regex:/^[A-Za-z0-9]{8,}$/', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi gaboleh kosong.',
            'password.required' => 'Password baru wajib diisi gaboleh kosong.',
            'password.regex' => 'Password baru wajib minimal 8 karakter angka atau huruf.',
            'password.confirmed' => 'Konfirmasi password baru harus sama dengan password baru.',
        ]);

        $user = Auth::user();

        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with('success', 'Password akun berhasil diubah.');
    }

    public function history()
    {
        $orders = Auth::user()
            ->orders()
            ->with('destination.city')
            ->where('status', 'paid')
            ->latest()
            ->get();

        return view('profile.history', compact('orders'));
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function help($tab = 'faq')
    {
        return view('settings.help', compact('tab'));
    }

    public function reportStore(Request $request)
    {
        $data = $request->validate([
            'guide_name' => ['required', 'string', 'max:255'],
            'guide_phone' => ['required', 'regex:/^08[0-9]{8,13}$/'],
            'group_link' => ['required', 'url', 'max:255'],
            'destination_name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ], [
            'guide_name.required' => 'Nama pemandu wajib diisi gaboleh kosong.',
            'guide_phone.required' => 'Nomor pemandu wajib diisi gaboleh kosong.',
            'guide_phone.regex' => 'Nomor pemandu wajib diawali 08.',
            'group_link.required' => 'Link grub wisata wajib diisi gaboleh kosong.',
            'group_link.url' => 'Link grub wisata wajib berupa URL yang valid.',
            'destination_name.required' => 'Destinasi wisata wajib diisi gaboleh kosong.',
            'description.required' => 'Deskripsi masalah wajib diisi gaboleh kosong.',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        Report::create($data);

        return back()->with('success', 'Laporan berhasil dikirim.');
    }
}
