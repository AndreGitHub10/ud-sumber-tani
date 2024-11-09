<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostKategoriRequest extends FormRequest
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
			'nama' => 'required',

			# value "nullable" berfungsi untuk menjaga key supaya bisa ditangkap/diakses di __construct DTO
			'id_kategori' => 'nullable',
			'model_kategori' => 'nullable',
		];
	}

	public function messages(): array
	{
		return [
			'nama.required' => 'Nama Kategori Wajib diisi',
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
