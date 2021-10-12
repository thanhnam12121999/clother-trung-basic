<?php

namespace App\Services;

use App\Repositories\SlideRepository;
use App\Traits\HandleImage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SlideService extends BaseService
{
    use HandleImage;

    protected $slideRepository;

    public function __construct(SlideRepository $slideRepository) {
        $this->slideRepository = $slideRepository;
    }

    public function getAll()
    {
        return $this->slideRepository->all();
    }

    public function getSlideToShow($limit)
    {
        return $this->slideRepository->getSlideToShow($limit);
    }

    public function store($request) {
        try {
            DB::beginTransaction();
            $slideData = $request->only(['content', 'title']);
            $featureImage = $request->file('image');
            $newNameOfSlide = $this->createImage($featureImage, 'slides');
            if (!$newNameOfSlide) {
                return $this->sendError('Lỗi thêm hình ảnh slide, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
            }
            $slideData['image'] = $newNameOfSlide;
            $slide = $this->slideRepository->create($slideData);
            DB::commit();
            return $this->sendResponse('Slide đã được thêm thành công.', [
                'slide' => $slide
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function getSlideById($id)
    {
        return $this->slideRepository->find($id);
    }

    public function updateSlide($id, $request)
    {
        try {
            DB::beginTransaction();
            $slide = $this->slideRepository->find($id);
            $slideData = $request->only(['content', 'title']);
            if ($request->hasFile('image')) {
                $response = $this->deleteImage($slide->image, 'slides');
                if (!$response) {
                    throw new \Exception;
                }
                $imageSlide = $request->file('image');
                $newNameImage = $this->createImage($imageSlide, 'slides');
                if (!$newNameImage) {
                    return $this->sendError('Lỗi thêm ảnh cho slide, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $slideData['image'] = $newNameImage;
            }
            $this->slideRepository->update($id, $slideData);
            DB::commit();
            return $this->sendResponse('Slide đã được sửa thành công.', [
                'slide' => $slide
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $slide = $this->slideRepository->find($id);
            $slideImages = $slide->image;
            $isDelete = $this->deleteImage($slideImages, 'slides');
            if (!$isDelete) {
                throw new \Exception;
            }
            $slide->delete();
            DB::commit();
            return $this->sendResponse('Xóa slide thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }
}
