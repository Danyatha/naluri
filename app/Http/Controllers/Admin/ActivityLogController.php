<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    /**
     * Menampilkan daftar log aktivitas.
     */
    public function index()
    {
        // Jika kamu punya tabel 'activity_logs'
        $logs = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.activity.index', compact('logs'));
    }

    /**
     * Menyimpan aktivitas (opsional jika perlu)
     */
    public function store(Request $request)
    {
        $idAdmin = Auth::id();
        DB::table('activity_logs')->insert([
            'user_id'    => $idAdmin,
            'activity'   => $request->activity,
            'ip_address' => $request->ip(),
            'created_at' => now(),
        ]);

        return back()->with('success', 'Log berhasil ditambahkan');
    }
}
