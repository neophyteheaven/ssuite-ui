@props([
    'tenant' => null,          // App\Models\Tenant|null — drives logo + brand colour
    'title' => null,           // optional heading rendered at the top of the card
    'preheader' => null,       // hidden inbox-preview text
    'ctaText' => null,         // primary call-to-action label
    'ctaUrl' => null,          // primary call-to-action url
    'unsubscribeUrl' => null,  // footer "manage preferences" link
])
@php
    // App-level default branding (used when there is no tenant). Read from
    // SystemSetting where the app has it; guarded so apps without it fall back
    // to config cleanly.
    $sysBrand = null; $sysLogo = null; $themeBrand = null;
    if (class_exists(\App\Models\SystemSetting::class)) {
        try {
            $sysBrand = \App\Models\SystemSetting::get('mail_brand_color');   // explicit email override (optional)
            $sysLogo = \App\Models\SystemSetting::get('mail_logo_url');
            $themeBrand = \App\Models\SystemSetting::get('theme_brand_600');   // the app's brand colour (set in /saas/{product}/settings)
        } catch (\Throwable $e) {
            // settings table not present — ignore
        }
    }
    // Priority: per-tenant → explicit email override → app theme colour → config default.
    $brand = $tenant?->brand_color ?: ($sysBrand ?: ($themeBrand ?: config('mail.brand.color', '#4f46e5')));
    $logoUrl = $tenant?->logo_url ?: $sysLogo;
    $appName = config('app.name');
    $appUrl = config('app.url');
    $prefsUrl = $unsubscribeUrl ?: (\Illuminate\Support\Facades\Route::has('profile.edit') ? route('profile.edit') : $appUrl);
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light" />
    <title>{{ $title ?? $appName }}</title>
</head>
<body style="margin:0; padding:0; width:100%; background-color:#f4f4f5; -webkit-text-size-adjust:100%; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
    @if ($preheader)
        <div style="display:none; max-height:0; overflow:hidden; opacity:0;">{{ $preheader }}</div>
    @endif
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f4f4f5;">
        <tr>
            <td align="center" style="padding:32px 12px;">

                {{-- Header / logo --}}
                <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="width:600px; max-width:100%;">
                    <tr>
                        <td align="center" style="padding:0 0 20px;">
                            <a href="{{ $appUrl }}" style="text-decoration:none;">
                                @if ($logoUrl)
                                    <img src="{{ $logoUrl }}" alt="{{ $appName }}" height="40" style="display:block; height:40px; max-height:40px; border:0; outline:none;" />
                                @else
                                    <span style="font-size:20px; font-weight:700; color:#18181b;">{{ $appName }}</span>
                                @endif
                            </a>
                        </td>
                    </tr>
                </table>

                {{-- Card --}}
                <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="width:600px; max-width:100%; background-color:#ffffff; border:1px solid #e4e4e7; border-radius:10px; overflow:hidden;">
                    <tr>
                        <td style="height:4px; background-color:{{ $brand }}; font-size:0; line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            @if ($title)
                                <h1 style="margin:0 0 20px; font-size:20px; font-weight:700; color:#18181b;">{{ $title }}</h1>
                            @endif

                            <div style="font-size:16px; line-height:1.6; color:#3f3f46;">
                                {{ $slot }}
                            </div>

                            @if ($ctaText && $ctaUrl)
                                <table cellpadding="0" cellspacing="0" role="presentation" style="margin:28px 0 8px;">
                                    <tr>
                                        <td align="center" style="border-radius:8px; background-color:{{ $brand }};">
                                            <a href="{{ $ctaUrl }}" target="_blank" style="display:inline-block; padding:12px 28px; font-size:15px; font-weight:600; color:#ffffff; text-decoration:none; border-radius:8px;">{{ $ctaText }}</a>
                                        </td>
                                    </tr>
                                </table>
                                <p style="margin:8px 0 0; font-size:12px; line-height:1.5; color:#a1a1aa;">
                                    {{ __('notifications.common.button_fallback') }}<br>
                                    <a href="{{ $ctaUrl }}" target="_blank" style="color:{{ $brand }}; word-break:break-all;">{{ $ctaUrl }}</a>
                                </p>
                            @endif
                        </td>
                    </tr>
                </table>

                {{-- Footer --}}
                <table width="600" cellpadding="0" cellspacing="0" role="presentation" style="width:600px; max-width:100%;">
                    <tr>
                        <td align="center" style="padding:20px 16px 0;">
                            <p style="margin:0 0 6px; font-size:12px; line-height:1.6; color:#a1a1aa;">
                                &copy; {{ date('Y') }} {{ $appName }}. {{ __('notifications.common.rights') }}
                            </p>
                            <p style="margin:0; font-size:12px; line-height:1.6; color:#a1a1aa;">
                                <a href="{{ $prefsUrl }}" target="_blank" style="color:#a1a1aa; text-decoration:underline;">{{ __('notifications.common.manage_preferences') }}</a>
                            </p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</body>
</html>
