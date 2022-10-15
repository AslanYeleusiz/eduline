<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SubscriptionsResource;
use App\Http\Resources\V1\MessageResource;
use App\Http\Resources\V1\Errors\MsgStatusFalseResource;
use App\Exceptions\ErrorException;
use App\Models\Subscription;
use App\Models\PromoCode;
use App\Models\UsedPromocodes;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::isActive()->get();
        return SubscriptionsResource::collection($subscriptions)->additional(['status' => true]);
    }

    public function promocode(Request $request) {
        $now = Carbon::now();
        $user = auth()->guard('api')->user();
        $promocode = PromoCode::isActive()->where('code', $request->code)->first();
        if(!empty($promocode)){
            if($promocode->to_date > $now){
                $used_promocode = UsedPromocodes::where('user_id', $user->id)->where('promo-code-id', $promocode->id)->first();
                if(!empty($used_promocode)){
                    UsedPromocodes::create([
                        'user_id' => $user->id,
                        'promo_code_id' => $promocode->id,
                    ]);
                    UserSubscription::create([
                        'user_id' => $user->id,
                        'subscription_id' => 1,
                        'from_date' => $now,
                        'to_date' => $now->addDays($promocode->day),
                    ]);
                    $promocode->increment('used_counts');
                    return new MessageResource(__('message.promo.success'));
                }
                return new MsgStatusFalseResource(__('message.promo.is_used'));
            }
            return new MsgStatusFalseResource(__('message.promo.date_leave'));
        }
        return new MsgStatusFalseResource(__('message.promo.not_found'));
    }
}
