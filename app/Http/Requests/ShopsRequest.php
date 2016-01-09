<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ShopsRequest extends Request {

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
			"name" => "required|min:2",
			"content" => "required|min:10",
			"price" => "required|min:1|numeric",
			"time" => "required|min:1|numeric",
			"image" => "required|min:5|url"
		];
	}

}
