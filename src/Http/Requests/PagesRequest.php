<?php

namespace Shetabit\PageBuilder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'brief_text' => 'nullable|string|max:255',
            'contents' => 'nullable|string',
            'category_id' => 'bail|required|integer|exists:page_categories,id',
            'image' => 'bail|nullable|image',
            'status' => 'required|integer|in:0,1',
            // 'priority' => 'required|integer|min:1|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'brief_text' => 'توضیح خلاصه',
            'contents' => 'متن',
            'category_id' => 'دسته بندی',
            'status' => 'وضعیت',
            'priority' => 'اولویت',
        ];
    }
}
