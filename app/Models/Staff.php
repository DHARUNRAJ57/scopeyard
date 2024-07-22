<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'gender', 'employment_type', 'technologies_known', 'joining_date', 'photo',
    ];

    protected $casts = [
        'technologies_known' => 'array',
    ];
}
