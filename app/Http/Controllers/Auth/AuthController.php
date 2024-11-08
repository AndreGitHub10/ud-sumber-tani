<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

# DTO
// use App\DataTransferObjects\UserDTO;
use App\DataTransferObjects\User\PostUserDTO;
// use App\DataTransferObjects\SimpleUserDTO;
// use App\DataTransferObjects\CreatePostDataNow;

# Form request validation
use App\Http\Requests\User\PostUserRequest;

# Models
use App\Models\Auth\User;

# Services
use App\Services\User\UserService;

class AuthController extends Controller
{
	private UserService $userService;

	public function __construct(
		UserService $userService
	)
	{
		$this->userService = $userService;
	}

	public function login(Request $request)
	{
		return view('contents.login.main');
	}

	public function generateToken(Request $request)
	// public function login(PostUserDTO $request)
	// public function login(PostUserRequest $request)
	{
		if (User::where('username',$request->username)->first() && Auth::attempt($request->only('username','password'))) {
			return response()->json([
				'code' => 200,
				'message' => 'Login berhasil',
			], 200);
		}
		
		return response()->json([
			'code' => 401,
			'message' => 'Username atau password tidak valid!',
		], 401);
		// $request->merge([
		// 	// 'name' => 'kata kata hari ini',
		// 	// 'username' => 'Dwialim',
		// 	// 'level' => 'kaSir',
		// 	// 'is_api' => '1',
		// 	// // 'email' => 'test@gmail.com',
		// 	// 'number' => '10',
		// 	// 'user' => 1,
		// 	// 'name' => 'dwi alim',
		// 	// 'email' => 'testing',
		// 	// 'password' => 'M@t3m4t1k4',

			
		// 	'name' => 'dwi alim',
		// 	'level' => 'admin',
		// 	'username' => 'dwiAlim',
		// 	// 'email' => 'Emails',
		// 	'password' => 'dwialim',
		// ]);

		// $post = UserDTO::fromArray([
		// 	'user' => 2,
		// 	// 'user' => User::all(),
		// 	// 'name' => 'DWI Alim',
		// 	'username' => 'Dwialim',
		// 	'level' => 'adMin',
		// 	// 'tags' => "html,php,javascript",
		// 	// 'email' => 'test@gmail.com',
		// 	'number' => '10',
		// ]);
		// return $request;
		// $post = PostUserDTO::fromRequest($request);
		$post = $request;
		// $post = $request->all();
		// $post = PostUserDTO::fromArray([
		// 	'name' => 'dwi alim',
		// 	'level' => 'admin',
		// 	'username' => 'dwiAlim',
		// 	'email' => 'email',
		// 	'password' => 'dwialim',
		// ]);
		// $post = UserDTO::fromArray(['user' => 'admin']);
		// $post = UserDTO::fromArray(['post' => 'admin']);

		// $post = UserDTO::fromRequest($request);
		return response()->json([
			'code' => 200,
			'message' => 'Ok',
			// 'response' => User::all(),
			'response' => $post,
		], 200);

		// $dto = UserDTO::fromRequest($request);
		// $dto = SimpleUserDTO::fromRequest($request);
		// $dto = CreatePostDataNow::fromRequest($request);
		$dto = CreatePostDataNow::fromArray([
			// 'user' => 1,
			'name' => 'dwi alim',
			'email' => 'testing',
			'password' => 'M@t3m4t1k4',
		]);

		return $dto;
		// return $dto->toArray();
		return response()->json(json_decode($dto->toJson()));








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

	public function removeToken(Request $request)
	{
		$request->session()->flush();
		Auth::logout();
		return redirect()->route('auth.login');
	}

	public function store(Request $request)
	{
		return response()->json([
			'code' => 200,
			'message' => 'Ok',
			'response' => User::all(),
		], 200);
	}
}
