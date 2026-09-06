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
        'title',
        'subtitle',
        'brief',
        'desc',
        'project_goal',
        'cat_id',
        'image_url',
        'number',
        'challenge',
        'solution',
        'client_name',
        'client_role',
        'launch_year',
        'duration',
        'project_link',
        'testimonial'
    ];

    public $casts = [
        'cat_id' => 'integer',
        'number' => 'integer'
    ];

    // دسته‌بندی پروژه
    public function category()
    {
        return $this->belongsTo(Categories::class, 'cat_id', 'id');
    }

    // رابطه با تصاویر
    public function Images()
    {
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

    // رابطه با تکنولوژی‌ها
    public function technologies()
    {
        return $this->hasMany(ProjectTechnology::class, 'project_id')->orderBy('order');
    }
    // رابطه با سرویس‌ها
    public function services()
    {
        return $this->hasMany(ProjectService::class, 'project_id')->orderBy('order');
    }
    public function features()
    {
        return $this->hasMany(ProjectFeature::class, 'project_id', 'id');
    }
}