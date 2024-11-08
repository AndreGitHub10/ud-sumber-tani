<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostSupplierRequest extends FormRequest
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
			'nama' => ['required', 'string', 'min:3']
		];
	}

	public function messages(): array
	{
		return [
			'nama.required' => 'Nama Wajib diisi',
			'nama.string' => 'Harus berupa text',
			'nama.min' => 'Nama min. 3 karakter',
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
