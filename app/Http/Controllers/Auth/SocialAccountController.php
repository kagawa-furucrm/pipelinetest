<?php

namespace App\Http\Controllers\Auth;

use App\SocialAccountsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAccountController extends Controller
{

    public function redirectToProvider($provider) {
        return \Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, SocialAccountsService $accountService, $provider) {

        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $authUser = $accountService->find($user, $provider);

        if ($authUser) { // 連携アカウントが登録済み
            auth()->login($authUser, true);
            return redirect('/home');
        } else { // まだ登録なし
            if ($request->user()) { // 既ログインの場合、連携アカウントとして登録し、アカウントに紐付ける
                if ($accountService->link($request->user(), $user, $provider)) {
                    return redirect('/home');
                } else {  // 既に同じサービスのアカウントでの登録があり、紐付け失敗
                    return redirect('/home')->withErrors(['social' => '同一サービスの連携ログインが既に登録されています']);
                }
            } else { // ログインしていない場合
                return redirect('/login');
            }
        }
    }
}
