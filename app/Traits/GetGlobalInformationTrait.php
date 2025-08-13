<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;


trait GetGlobalInformationTrait {

    private function getMultiCurrencyInfo($currency_code = null) {
        if (is_null($currency_code)) {
            $currency_code = getSessionCurrency();
        }
        $gateway_currency = allCurrencies()->where('currency_code', $currency_code)->first();

        return [
            'currency_code' => $gateway_currency->currency_code,
            'country_code'  => $gateway_currency->country_code,
            'currency_rate' => $gateway_currency->currency_rate,
            'currency_id'   => $gateway_currency->id,
        ];
    }

    /**
     * @param $currencyId
     */
    private function getCurrencyDetails($currencyId) {
        $gateway_currency = allCurrencies()->where('id', $currencyId)->first();

        return [
            'currency_code' => $gateway_currency->currency_code,
            'country_code'  => $gateway_currency->country_code,
            'currency_rate' => $gateway_currency->currency_rate,
        ];
    }



    // mail configuraton setup
    private function set_mail_config() {
        $email_setting = Cache::get('setting');
        $mailConfig = [
            'transport'  => 'smtp',
            'host'       => $email_setting->mail_host,
            'port'       => (int) $email_setting->mail_port,
            'encryption' => $email_setting->mail_encryption,
            'username'   => $email_setting->mail_username,
            'password'   => $email_setting->mail_password,
            'timeout'    => null,
        ];

        config(['mail.mailers.smtp' => $mailConfig]);
        config(['mail.from.address' => $email_setting->mail_sender_email]);
        config(['mail.from.name' => $email_setting->mail_sender_name]);
    }
}
