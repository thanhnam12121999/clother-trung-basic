<?php

namespace App\Repositories;

use App\Models\Slider;

class SlideRepository extends BaseRepository
{
    public function model()
    {
        return Slider::class;
    }

    public function getSlideToShow($limit)
    {
        return $this->model->latest()->take($limit)->get();
    }
    
}