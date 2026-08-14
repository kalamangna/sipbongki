<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Mask NIK (e.g. 7307011234560001 -> 730701******0001).
     */
    public static function maskNik(?string $nik): string
    {
        if (empty($nik) || $nik === '-') {
            return '-';
        }

        $cleanNik = preg_replace('/[^\d]/', '', (string)$nik);
        $length = strlen($cleanNik);
        if ($length < 8) {
            return str_repeat('*', $length);
        }

        $prefix = substr($cleanNik, 0, 6);
        $suffix = substr($cleanNik, -4);
        $maskLength = max(1, $length - 10);

        return $prefix . str_repeat('*', $maskLength) . $suffix;
    }

    /**
     * Mask Phone Number (e.g. 081234567890 -> 0812****7890).
     */
    public static function maskPhone(?string $phone): string
    {
        if (empty($phone) || $phone === '-') {
            return '-';
        }

        $cleanPhone = preg_replace('/[^\d+]/', '', (string)$phone);
        $length = strlen($cleanPhone);

        if ($length <= 6) {
            return substr($cleanPhone, 0, 2) . str_repeat('*', max(1, $length - 2));
        }

        $prefix = substr($cleanPhone, 0, 4);
        $suffix = substr($cleanPhone, -4);
        $maskLength = max(1, $length - 8);

        return $prefix . str_repeat('*', $maskLength) . $suffix;
    }

    /**
     * Mask Email Address (e.g. user@domain.com -> u***@domain.com).
     */
    public static function maskEmail(?string $email): string
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return '-';
        }

        [$username, $domain] = explode('@', (string)$email, 2);
        $length = strlen($username);

        if ($length <= 2) {
            $maskedUser = substr($username, 0, 1) . '*';
        } else {
            $maskedUser = substr($username, 0, 1) . str_repeat('*', max(1, $length - 2)) . substr($username, -1);
        }

        return $maskedUser . '@' . $domain;
    }
}
