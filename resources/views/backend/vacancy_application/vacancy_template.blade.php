@php
    // Fallbacks if not passed
    $appName      = $companyName ?? config('app.name');
    $appUrl       = $companyUrl ?? config('app.url');
    $supportEmail = $supportEmail ?? config('mail.from.address');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $subject ?? 'Regarding Your Job Application' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic email-safe styles – inline as much as possible in real usage */
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f7;
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
        }
        .wrapper {
            width: 100%;
            padding: 20px 0;
        }
        .main-table {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e3e3e3;
        }
        .header {
            background: #1a73e8;
            color: #ffffff;
            padding: 18px 24px;
            font-size: 18px;
            font-weight: bold;
        }
        .header span {
            font-size: 14px;
            font-weight: normal;
            opacity: 0.9;
        }
        .content {
            padding: 24px;
            font-size: 14px;
            line-height: 1.6;
        }
        .footer {
            font-size: 12px;
            color: #777777;
            padding: 16px 24px 20px;
            background-color: #fafafa;
            border-top: 1px solid #eeeeee;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            background-color: #1a73e8;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            margin-top: 10px;
        }
        .small {
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <table class="main-table" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        {{-- Header --}}
        <tr>
            <td class="header">
                {{ $appName }}
                @if(!empty($jobTitle))
                    <br>
                    <span>Regarding your application for: {{ $jobTitle }}</span>
                @endif
            </td>
        </tr>

        {{-- Body --}}
        <tr>
            <td class="content">
                @if(!empty($applicantName))
                    <p>Dear {{ $applicantName }},</p>
                @else
                    <p>Dear Applicant,</p>
                @endif

                {{-- Main reply written from your editor --}}
                <p>
                    {!! $reply !!}
                </p>

                <p>Best regards,<br>
                    <strong>{{ $senderName ?? $appName }}</strong><br>
                    @if(!empty($senderPosition))
                        <span class="small">{{ $senderPosition }}<br></span>
                    @endif
                    @if(!empty($supportEmail))
                        <span class="small">{{ $supportEmail }}</span>
                    @endif
                </p>

                @if(!empty($appUrl))
                    <p class="small">
                        You can learn more about us at:
                        <a href="{{ $appUrl }}" style="color:#1a73e8;">{{ $appUrl }}</a>
                    </p>
                @endif
            </td>
        </tr>

        {{-- Footer --}}
        <tr>
            <td class="footer">
                <p>
                    This email was sent by {{ $appName }}.
                    If you received this email by mistake, please ignore it.
                </p>
                <p class="small">
                    &copy; {{ date('Y') }} {{ $appName }}. All rights reserved.
                </p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
