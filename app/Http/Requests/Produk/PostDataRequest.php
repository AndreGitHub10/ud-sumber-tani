<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostDataRequest extends FormRequest
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
			'nama_produk' => ['required', 'min:3'],
			'foto_directory' => ['nullable', 'file', 'mimes:jpeg,jpg,png', 'max:2048'],
			
			# value "nullable" berfungsi untuk menjaga key supaya bisa ditangkap/diakses di __construct DTO
			'id_data_produk' => 'nullable',
			// 'kategori_produk_id' => ['nullable', 'integer'],
			'kategori_id' => 'nullable',
			'model_data_produk' => 'nullable',
		];
	}

	public function messages(): array
	{
		return [
			'nama_produk.required' => 'Nama Produk Wajib diisi',
			'nama_produk.min' => 'Nama Produk min: 3 karakter',
			'foto_directory.file' => 'Foto harus berupa file',
			'foto_directory.mimes' => 'Format Foto: jpeg, jpg, png',
			'foto_directory.max' => 'Ukuran Foto max: 2MB',
			'kategori_id.nullable' => 'Ukuran Foto max: 2MB',
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
