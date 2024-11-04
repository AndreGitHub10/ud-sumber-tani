<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostUserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => ['required', 'string', 'min:3'],
			'level' => ['required', 'string', 'in:admin,kasir'],
			'username' => ['required', 'min:3'],
			'password' => ['required_without:user_id'],
		];
	}

	public function messages(): array
	{
		return [
			'name.required' => 'Nama Wajib diisi',
			'name.string' => 'Harus berupa text',
			'name.min' => 'Nama min. 3 karakter',

			'level.required' => 'Level Wajib diisi',
			'level.string' => 'Harus berupa text',
			'level.in' => 'Level tidak valid',

			'username.required' => 'Username Wajib diisi',
			'username.min' => 'Username min. 3 karakter',

			'password.required_without' => 'Password Wajib diisi',
		];
	}
	
	public function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(
			response()->json([
				'code' => 422,
				'message' => $validator->errors()->first()
			], 422)
		);
	}
}
