<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use DataTable;
use DataTables;
// use Yajra\DataTables\Services\DataTable;

# DTO
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\DataTransferObjects\User\PostUserDTO;

# Models
use App\Models\User;

# Services
use App\Services\User\UserService;

class UserController extends Controller
{
	private UserService $userService;
	public function __construct(
		UserService $userService
	)
	{
		$this->userService = $userService;
	}
	public function main(Request $request)
	{
		return view('contents.data-master.pengguna.main');
	}

	public function form(Request $request)
	{
		$content = view('contents.data-master.pengguna.form')->render();

		$dto = ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Ok',
			'response' => $content,
		]);

		return response()->json($dto, $dto->code);
	}

	public function datatables(Request $request)
	{
		return DataTables::of(User::all())
			->addIndexColumn()
			->toJson();
	}

	public function store(PostUserDTO $data)
	{
		$user = $this->userService->create($data);

		$dto = ResponseAxiosDTO::fromArray([
			'code' => 201,
			'message' => 'Data berhasil disimpan',
			'response' => $user,
		]);

		return response()->json($dto, $dto->code);
	}
}
