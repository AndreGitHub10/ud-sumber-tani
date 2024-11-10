<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
# DTO
use App\DataTransferObjects\Response\ResponseAxiosDTO;
use App\DataTransferObjects\User\DetailUserDTO;
use App\DataTransferObjects\User\PostUserDTO;
# Form request
use App\Http\Requests\User\PostUserRequest;
# Models
use App\Models\Auth\User;
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

	public function destroy(DetailUserDTO $data)
	{
		if ($data->res_code === 200 && !$this->userService->destroy($data)) {
			return response()->json(ResponseAxiosDTO::fromArray([
				'code' => 500,
				'message' => 'Data gagal dihapus',
			]), 500);
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
		]), $data->res_code);
	}

	public function form(Request $request)
	{
		$data = DetailUserDTO::fromRequest($request)->toArray();
		$data['user'] = $data['user'] !== null ? (object)$data['user'] : "";

		$content = view('contents.data-master.pengguna.form')->with($data)->render();

		$dto = ResponseAxiosDTO::fromArray([
			'code' => 200,
			'message' => 'Ok',
			'response' => $content,
		]);

		return response()->json($dto, $dto->code);
	}

	public function main(Request $request)
	{
		return view('contents.data-master.pengguna.main');
	}

	public function store(PostUserDTO $data)
	{
		if ($data->id_user) {
			$user = $this->userService->update($data);
		} else {
			$user = $this->userService->create($data);
		}

		return response()->json(ResponseAxiosDTO::fromArray([
			'code' => $data->res_code,
			'message' => $data->res_message,
			'response' => $user,
		]), $data->res_code);
	}
}
