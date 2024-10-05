<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SettingModel;
use Config;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $mail = json_decode(SettingModel::where('key_value', 'setting-email-account')->first()->value, true);


        if (empty($mail)) {
            return false;
        } else {
            Config::set('mail.username', $mail['email_account_username']);
            Config::set('mail.password', $mail['email_account_password']);
        }
    }
}
