<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\CardsResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        $this->load('subscription.subscription');

        $subscription = null;
        if ($this->subscription) {
            $dur_id = $this->subscription->subscription->id;
            $duration_days = Carbon::parse($this->subscription->from_date)->diff(Carbon::parse($this->subscription->to_date))->format('%d');
            $subscription = [
                'id' => $dur_id,
                'name' => $this->subscription->subscription->name,
                'duration' => $this->subscription->subscription->duration,
                'duration_days' => $duration_days,
                'from_date' => Carbon::create( $this->subscription->from_date)->format('d.m.Y'),
                'to_date' => Carbon::create($this->subscription->to_date)->format('d.m.Y'),
                'created_at' => $this->subscription->created_at?->format('d.m.Y H:i'),
            ];
        }
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'place_work' => $this->place_work,
            'sex' => $this->sex,
            'birthday' => $this->birthday,
            'avatar' => $this->avatar ? Storage::disk('public')->url(User::IMAGE_PATH . $this->avatar) : null,
            'subscription' => $subscription,
        ];
    }

    public function with($request)
    {
        return ['status' => true];
    }
}
