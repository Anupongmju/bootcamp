<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory; //ฟิลด์ที่ระบุใน $fillable จะสามารถรับค่าจาก input เพื่อบันทึกลงในฐานข้อมูล เช่น ข้อมูลชื่อ (name), อีเมล (email), และรหัสผ่าน (password)
    //
    protected $fillable = [
        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
