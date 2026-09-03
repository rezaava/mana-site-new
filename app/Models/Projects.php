<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Images;

class Projects extends Model
{
    use HasFactory;
    public $table = 'projects';
    public $fillable = [
        'title', 'subtitle', 'brief', 'desc', 'project_goal', 'cat_id', 'image_url', 'number',
        'challenge', 'solution', 'client_name', 'client_role', 'launch_year', 'duration', 
        'project_link', 'testimonial'
    ];
    public $casts = [
        'cat_id' => 'integer',
        'number' => 'integer'
    ];

    // رابطه با تصاویر (قدیمی)
    public function Images(){
        return $this->hasMany(Images::class);
    }

    // رابطه با آمارها
    public function stats()
    {
        return $this->hasMany(ProjectStat::class, 'project_id');
    }

    // رابطه با گالری دسته‌بندی شده
    public function galleries()
    {
        return $this->hasMany(ProjectGallery::class, 'project_id');
    }

    // رابطه با تکنولوژی‌ها (جدید)
    public function technologies()
    {
        return $this->hasMany(ProjectTechnology::class, 'project_id')->orderBy('order');
    }

    // رابطه با ویژگی‌های کلیدی (Features)
    public function features()
    {
        return $this->hasMany(Features::class, 'sub-id', 'id')->where('type', 1);
    }

    public function services()
    {
        return $this->hasMany(ProjectService::class, 'project_id')->orderBy('order');
    }
}