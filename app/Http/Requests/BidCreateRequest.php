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
        $offset=$this->input('offset')/60;

        if($offset<0)
        $now=\Carbon\Carbon::now()->subHours($offset);
        else
          $now=\Carbon\Carbon::now()->addHours($offset);

       if($this->input('expirationDate')>\Carbon\Carbon::now())
       {
         return [
           'amount'          => "required|numeric|max: $price",
           'product_id'      => "required|unique:bids,product_id,". $this->input('product_id'),
           'reservedPrice'   => "required|numeric|min: ".$this->input('amount'),
           'expirationDate'  => "required|after:". \Carbon\Carbon::now()->subDay(),
           'expirationTime'        => 'required|date_format:H:i'
         ];

       } else
        return [
          'amount'          => "required|numeric|max: $price",
          'product_id'      => "required|unique:bids,product_id,". $this->input('product_id'),
          'reservedPrice'   => "required|numeric|min: ".$this->input('amount'),
          'expirationDate'  => "required|after:". \Carbon\Carbon::now()->subDay(),
          'expirationTime'        => 'required|date_format:H:i|after:'.$now
        ];
	}

}
