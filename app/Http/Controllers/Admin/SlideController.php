<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use App\Services\SlideService;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    protected $slideService;

    public function __construct(SlideService $slideService) {
        $this->slideService = $slideService;
    }

    public function index() 
    {
        $slides = $this->slideService->getAll();
        return view('admin.slide.index', compact('slides'));
    }

    public function create() 
    {
        return view('admin.slide.create');
    }

    public function store(StoreSlideRequest $request) 
    {
        $response = $this->slideService->store($request);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function edit(int $id)
    {
        $slide = $this->slideService->getSlideById($id);
        return view('admin.slide.edit', compact('slide'));
    }

    public function update(int $id, UpdateSlideRequest $request)
    {
        $response = $this->slideService->updateSlide($id, $request);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function destroy(int $id)
    {
        $response = $this->slideService->delete($id);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}
