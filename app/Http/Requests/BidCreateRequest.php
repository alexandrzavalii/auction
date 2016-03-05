<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class BidCreateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
            protected $table = 'bids';
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
        $price = $this->input('max');
      
        return [
          'expirationDate'        => "required|after:". \Carbon\Carbon::now()->subDay(),
        'expirationTime'        => 'required|date_format:H:i|after:'.\Carbon\Carbon::now()->toTimeString(),
          'amount'         => "required|numeric|max: $price",
        'product_id' => "required|unique:bids,product_id,". $this->get('product_id'),
        ];
	}

}
