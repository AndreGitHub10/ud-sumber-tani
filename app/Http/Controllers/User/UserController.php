<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use DataTable;
use DataTables;
// use Yajra\DataTables\Services\DataTable;

# DTO
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\DataTransferObjects\User\DetailUserDTO;
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
			->addColumn('action', function($item) {
				return "
					<div class='text-center'>
						<button type='button' class='btn btn-sm btn-danger px-2 btn-delete-user' data-id='$item->id'>
							<i class='fadeIn animated bx bx-trash'></i>
						</button>
						<button type='button' class='btn btn-sm btn-warning px-2 btn-edit-user' data-id='$item->id'>
							<i class='fadeIn animated bx bx-pencil'></i>
						</button>
					</div>
				";
			})
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

	// public function destroy(DetailUserDTO $data)
	public function destroy(Request $request)
	{

		// if (!$this->userService->destroy($request)) {
		// 	return response()->json(ResponseAxiosDTO::fromArray([
		// 		'code' => 500,
		// 		'message' => 'Data gagal dihapus!'
		// 	]), 500);
		// }
		// $data = DetailUserDTO::fromArray(['user_id' => $request->user_id]);
		// $request->merge([
		// 	'id' => 1
		// ]);
		// $data = DetailUserDTO::fromRequest($request)->toArray();
		// return $data;
		// $data = $request->all();

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Data berhasil dihapus',
			'response' => $data,
		]), 200);
	}
}
