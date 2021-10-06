<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Services\ProductAttributeService;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    protected $productAttributeService;

    public function __construct(ProductAttributeService $productAttributeService)
    {
        $this->productAttributeService = $productAttributeService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeRequest $request)
    {
        if (!empty($request->errors)) {
            $errors = $request->errors->messages();
            return redirect()->back()->with('failed_validate', 'Đảm bảo tên thuộc tính và giá trị không được trống');
        }
        $response = $this->productAttributeService->createAttribute($request->validated());
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        if (!empty($request->errors)) {
            return redirect()->back()->with('failed_validate', 'Đảm bảo tên thuộc tính và giá trị không được trống');
        }
        $response = $this->productAttributeService->updateAttribute($request, $attribute);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
