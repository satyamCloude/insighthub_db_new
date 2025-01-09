<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use App\Models\MailSettings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();

        if ($MailSettings && $MailSettings->smtp == '1') {
            Config::set([
                'mail.driver'     => $MailSettings->smtp_mailer,
                'mail.host'       => $MailSettings->smtp_host,
                'mail.port'       => $MailSettings->smtp_port,
                'mail.username'   => $MailSettings->smtp_user_name,
                'mail.password'   => $MailSettings->smtp_password,
                'mail.encryption' => $MailSettings->smtp_encryption,
            ]);
        }elseif ($MailSettings && $MailSettings->microsoft == '1') {
            Config::set([
                'mail.driver'     => $MailSettings->microSmtp_mailer,
                'mail.host'       => $MailSettings->microSmtp_host,
                'mail.port'       => $MailSettings->microSmtp_port,
                'mail.username'   => $MailSettings->microSmtp_user_name,
                'mail.password'   => $MailSettings->microSmtp_password,
                'mail.encryption' => $MailSettings->microSmtp_encryption,
            ]);

            // Set the from configuration separately
            Config::set('mail.from', [
                'address' => $MailSettings->microSmtp_user_name,
                'name' => env('APP_NAME'), // You may change this to the desired name
            ]);
        }
    }
}
