<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd('here');
        return [
            'id' => $this->id,
            'name' => $this->last_name,
            'email' => $this->email,
            $this->mergeWhen(Auth::user() && Auth::user()->isAdmin(), [
                'role' => $this->role
            ]),

        ];
    }
}
