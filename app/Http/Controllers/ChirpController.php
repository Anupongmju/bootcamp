<?php
//จัดทรัพยาการของ chirps โดนการกำหนดสร้าง ลบ แก้ไข
namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //ส่งข้อมูล chirps ที่ดึงมาจากฐานข้อมูลไปยังหน้า front-end
    public function index(): Response
    {
        
        return Inertia::render('Chirps/Index', [
            //
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    //ตรวจสอบข้อมูลที่ส่งมาด้วย validate
    //สร้าง chirp ใหม่ผ่านผู้ใช้ที่เข้าสู่ระบบ ($request->user())
    public function store(Request $request): RedirectResponse //ควบคุมstore
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->chirps()->create($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //ใช้สำหรับแก้ไขข้อความของ chirp
    //ใช้ Gate::authorize('update', $chirp) เพื่อตรวจสอบสิทธิ์ว่าผู้ใช้มีสิทธิ์แก้ไข chirp นี้หรือไม่

    public function update(Request $request, Chirp $chirp): RedirectResponse //ตสบคุมการอัพเดท
    {
        Gate::authorize('update', $chirp);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);
 
        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    //ใช้สำหรับลบ chirp 
    //ตรวจสอบสิทธิ์การลบด้วย Gate::authorize('delete', $chirp)

    public function destroy(Chirp $chirp): RedirectResponse //ควบคุมการ delete
    {
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index'));
    }
}
