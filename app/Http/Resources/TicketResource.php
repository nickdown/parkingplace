<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => new UserResource($this->user),
            'entered_at' => Carbon::make($this->entered_at)->toDayDateTimeString(),
            'exited_at' => optional(Carbon::make($this->exited_at))->toDayDateTimeString(),
            'paid_at' => optional(Carbon::make($this->paid_at))->toDayDateTimeString(),
            'paid_amount' => $this->paid_amount,
            'isPaid' => $this->isPaid(),
            'rate' => new RateResource($this->rate())
        ];
    }
}
