<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserSaveRequest;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use App\Services\Admin\UserService;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        $fullName = $request->full_name;
        $email = $request->email;
        $phone = $request->phone;
        $sex = $request->sex;
        $users = User::with('role')
            ->when($fullName, fn ($query) => $query->where('full_name', 'like', "%$fullName%"))
            ->when($email, fn ($query) => $query->where('email', 'like', "%$email%"))
            ->when($phone, fn ($query) => $query->where('phone', 'like', "%$phone%"))
            ->when($sex, fn ($query) => $query->where('sex', 'like', "%$sex%"))
            ->latest()
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));

        return Inertia::render('Admin/Users/Index', [
            'users' => $users
        ]);
    }

    public function edit(User $user)
    {
        $roles = Role::get();
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(User $user, UserSaveRequest $request)
    {
        // return redirect()->back()->withSuccess('okkok');

        $user = $this->userService->save($user, $request);
        return redirect()->back()->withSuccess('Успешно сохранено');
    }

    public function create()
    {
        $roles = Role::get();

        return Inertia::render('Admin/Users/Create', [
            'roles' => $roles
        ]);
    }

    public function store(UserSaveRequest $request)
    {

        $user = new User();
        $user = $this->userService->save($user, $request);

        return redirect()->route('admin.users.index')->withSuccess('Успешно добавлено');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }

    public function userSubscriptions($userId, Request $request)
    {
        $user = User::findOrFail($userId);
        $name = $request->name;
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $createdAt = $request->created_at;
        $isActive = $request->is_active;
        $userSubscriptions = UserSubscription::with('subscription')
            ->where('user_id', $userId)
            ->when($name, function ($query) use ($name) {
                return $query->whereHas('subscription', fn ($query) => $query->where('name', 'like', "%$name%"));
            })
            ->when($fromDate, fn ($query) => $query->whereDate('from_date', '<=', $fromDate))
            ->when($toDate, fn ($query) => $query->whereDate('to_date', '>=', $toDate))
            ->when($createdAt, fn ($query) => $query->whereDate('created_at', '>=', $createdAt))

            ->addSelect('*', DB::raw(' (CASE WHEN CURDATE() BETWEEN from_date AND to_date THEN 1 ELSE 0 END ) as is_active'))
            ->when($isActive, function ($query) use ($isActive) {
                if ($isActive == 'true') {

                    return $query->whereDate('from_date', '<=', now())
                        ->whereDate('to_date', '>=', now());
                } else {
                    return $query->whereDate('to_date', '<=', now());
                }
            })
            ->orderByDesc('id')
            ->paginate($request->input('per_page', 20))
            ->appends($request->except('page'));
        $subscriptions = Subscription::isActive()->get();

        return Inertia::render(
            'Admin/Users/UserSubscriptions',
            compact('user', 'userSubscriptions', 'subscriptions')
        );
    }

    public function userSubscriptionStore($userId, $subscriptionId)
    {
        $user = User::findOrFail($userId);
        $subscription = Subscription::isActive()->findOrFail($subscriptionId);
        $currentDate = now();
        UserSubscription::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'from_date' => $currentDate->format('Y.m.d'),
            'to_date' => $currentDate->addMonths($subscription->duration)->format('Y.m.d')
        ]);

        return redirect()->back()->withSuccess('Успешно добавлено');
    }

    public function userSubscriptionDelete($userId, $subscriptionId)
    {
        $userSubscription = UserSubscription::findOrFail($subscriptionId);
        $userSubscription->delete();
        return redirect()->back()->withSuccess('Успешно удалено');
    }
}
