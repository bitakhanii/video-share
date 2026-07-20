<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

if (!function_exists('alert_redirect')) {
    function alert_redirect(
        string $route,
        string $message,
        string $attribute = '',
        string $type = 'success',
               $model = null,
        string $button = 'باشه',
        int    $autoClose = 3000): RedirectResponse
    {
        Alert::$type(__($message, ['attribute' => __('attributes.' . $attribute)]))
            ->showConfirmButton($button)
            ->autoClose($autoClose);

        return match ($route) {
            'back' => redirect()->back(),
            'intended' => redirect()->intended(),
            default => match ($model) {
                null => redirect()->route($route),
                default => redirect()->route($route, $model)
            },
            // default => redirect()->route($route),
        };
    }
}

if (!function_exists('success_redirect')) {
    function success_redirect(
        string $route,
        string $message,
        string $attribute = '',
               $model = null,
        string $button = 'باشه',
        int    $autoClose = 3000): RedirectResponse
    {
        return alert_redirect($route, 'alerts.success.' . $message, $attribute, 'success', $model, $button,
            $autoClose);
    }
}

if (!function_exists('error_redirect')) {
    function error_redirect(
        string $route,
        string $message,
        string $attribute = '',
               $model = null,
        string $button = 'باشه',
        int    $autoClose = 3000): RedirectResponse
    {
        return alert_redirect($route, 'alerts.error.' . $message, $attribute, 'error', $model, $button, $autoClose);
    }
}

if (!function_exists('info_redirect')) {
    function info_redirect(
        string $route,
        string $message,
        string $attribute = '',
               $model = null,
        string $button = 'باشه',
        int    $autoClose = 3000): RedirectResponse
    {
        return alert_redirect($route, 'alerts.info.' . $message, $attribute, 'info', $model, $button,
            $autoClose);
    }
}

if (!function_exists('json_redirect')) {
    function json_redirect($message, $attribute, $status = 200, $data = [], $icon = 'success', $autoClose = 1500):
    JsonResponse
    {
        return response()->json([
            'message' => __($message, ['attribute' => __('attributes.' . $attribute)]),
            'data' => $data,
            'icon' => $icon,
            'autoClose' => $autoClose,
        ], $status);
    }
}

if (!function_exists('json_success_redirect')) {
    function json_success_redirect($message, $attribute, $status = 200, $data = [], $autoClose = 1500):
    JsonResponse
    {
        return json_redirect('alerts.success.' . $message, $attribute, $status, $data, 'success', $autoClose);
    }
}

if (!function_exists('json_error_redirect')) {
    function json_error_redirect($message, $attribute, $status = 200, $data = [], $autoClose = 1500):
    JsonResponse
    {
        return json_redirect('alerts.error.' . $message, $attribute, $status, $data, 'error', $autoClose);
    }
}
