<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OffensesRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			"arma_id" => "required",
			"content" => "required|min:5",
			"sanction" => "required|min:2",
			"author" => "required|min:2",
			"author_id" => "required|numeric",
		];
	}

}
