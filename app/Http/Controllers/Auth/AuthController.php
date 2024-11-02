<?php

namespace App\Http\Controllers\Auth;

# Package
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# DTO
use App\DataTransferObjects\UserDTO;

# Models
use App\Models\Auth\User;

class AuthController extends Controller
{
	public function main(Request $request)
	{
		return view('contents.login.main');
	}

	public function login(Request $request)
	{
		$request->merge([
			'name' => 'kata kata hari ini',
			'username' => 'Dwialim',
			'level' => 'kaSir',
			'is_api' => '1',
			// 'email' => 'test@gmail.com',
			'number' => '10',
		]);

		$post = UserDTO::fromArray([
			'user' => User::all(),
			'name' => 'DWI Alim',
			'username' => 'Dwialim',
			'level' => 'adMin',
			'is_api' => '1',
			// 'email' => 'test@gmail.com',
			'number' => '10',
		]);
		// $post = UserDTO::fromArray(['user' => 'admin']);
		// $post = UserDTO::fromArray(['post' => 'admin']);

		// $post = UserDTO::fromRequest($request);
		return response()->json([
			'code' => 200,
			'message' => 'Ok',
			// 'response' => User::all(),
			'response' => $post,
		], 200);
		return $post;
		// return $post->transform();
		$post = $this->repository->create(
			UserDTO::fromRequest($request)
		);
		return $post;
		return $data = UserDTO::fromArray([
			'name' => 'DWI Alim',
			'username' => 'Dwialim',
			'level' => 'kaSir',
			'is_api' => '1',
			'email' => 'test@gmail.com',
			'number' => '10',
		])->transform();
		// UserDTO::
		return response()->json([
			'code' => 200,
			'message' => 'Ok',
			// 'response' => User::all(),
			'response' => $data,
		], 200);
	}

	public function testing(Request $request)
	{
		return response()->json([
			'code' => 200,
			'message' => 'Ok',
			'response' => User::all(),
		], 200);
	}
}
