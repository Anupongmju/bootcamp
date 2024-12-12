<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory>
     * 
     * HasFactory: เปิดใช้งานการสร้างข้อมูลตัวอย่าง (Factory) สำหรับโมเดล
    Notifiable: เพิ่มความสามารถในการส่งการแจ้งเตือน เช่น อีเมล หรือข้อความ
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *ฟิลด์ที่ระบุใน $fillable จะสามารถรับค่าจาก input 
     *เพื่อบันทึกลงในฐานข้อมูล เช่น ข้อมูลชื่อ (name), อีเมล (email), และรหัสผ่าน (password)
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class);
    }
}
