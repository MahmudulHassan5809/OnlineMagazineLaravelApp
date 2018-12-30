<?php

namespace App\Http\Requests;

use App\Exceptions\NotAuthorizedException;
use Illuminate\Foundation\Http\FormRequest;


class CategoryDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return !($this->route('category') == config('cms.default_category_id'));

    }

    public function failedAuthorization() {
        $exception = new NotAuthorizedException('This action is unauthorized.', 403);
        throw $exception->redirectTo('backend/categories');
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
