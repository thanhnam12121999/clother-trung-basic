<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'username' => $this->username,
            'accountable' => new ManagerResource($this->accountable),
            'phone_number' => $this->phone_number,
            'date_of_birth' => $this->date_of_birth,
            'avatar' => $this->avatar,
            // 'status' => $this->status,
        ];
    }


}
