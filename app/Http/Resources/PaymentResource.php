<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'paid_on' => $this->paid_on,
            'details' => $this->details !== NULL ? $this->details : ' ',
        ];
    }
}
