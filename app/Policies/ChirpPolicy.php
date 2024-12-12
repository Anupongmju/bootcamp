<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChirpPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     * 
     * สิ่งนี้จะสร้างคลาส Policy ที่ app/Policies/ChirpPolicy.php 
     * ซึ่งเราสามารถอัปเดตเพื่อระบุว่าเฉพาะผู้เขียนเท่านั้นที่ได้รับอนุญาตให้แก้ไข Chirp ได้
     */
    public function update(User $user, Chirp $chirp): bool
    {
        return $chirp->user()->is($user);
        
    }

    /**
     * Determine whether the user can delete the model.
     * ฟังก์ชันนี้จะตรวจสอบว่าผู้ใช้สามารถลบ Chirp ได้หรือไม่
ในที่นี้ จะอนุญาตให้ลบได้เฉพาะผู้ที่สามารถอัปเดต Chirp ได้ ซึ่งหมายถึงเจ้าของ Chirp เท่านั้น
     */
    public function delete(User $user, Chirp $chirp): bool
    {
        return $this->update($user, $chirp);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chirp $chirp): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        return false;
    }
}
