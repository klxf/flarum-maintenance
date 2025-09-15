<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->get('forum_title') }}</title>
    <style>
        body {
            margin: 0;
        }
        .main {
            text-align: center;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .logo-container {
            margin: 64px 0;
        }
        .logo {
            fill: {{ $settings->get('theme_primary_color') }};
            height: 128px;
        }
        .footer-content {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin: 16px 0;
        }
        .footer-logo {
            font-size: 24px;
            color: {{ $settings->get('theme_primary_color') }};
        }
        .footer-copyright {
            font-size: 12px;
            opacity: .6;
        }
    </style>
    @if ($forumStyle !== '')
    <style>
        {!! $forumStyle !!}
    </style>
    @endif
</head>

<body>
<div class="main">
    <div class="logo-container">
        <svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
            <path d="M480 288c0-80.25-49.28-148.92-119.19-177.62L320 192V80a16 16 0 0 0-16-16h-96a16 16 0 0 0-16 16v112l-40.81-81.62C81.28 139.08 32 207.75 32 288v64h448zm16 96H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h480a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"/>
        </svg>
    </div>
    <h1>{{ $settings->get('klxf-maintenance.title') }}</h1>
    <div class="content">{!! $settings->get('klxf-maintenance.message') !!}</div>
</div>

<div class="footer">
    <div class="footer-content">
        <div class="footer-logo">{{ $settings->get('forum_title') }}</div>
        <div class="footer-copyright">
            This page using <a href="https://github.com/klxf/flarum-maintenance" target="_blank">klxf/flarum-maintenance</a>.
        </div>
    </div>
</div>
</body>

</html>