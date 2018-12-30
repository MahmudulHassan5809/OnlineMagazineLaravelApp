<?php

namespace App\Http\Requests;

use App\Exceptions\NotAuthorizedException;
use Illuminate\Foundation\Http\FormRequest;

class UserDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return !($this->route('user') == config('cms.default_user_id'));

    }

    public function failedAuthorization() {
        $exception = new NotAuthorizedException('This action is unauthorized.', 403);
        throw $exception->redirectTo('backend/users');
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
