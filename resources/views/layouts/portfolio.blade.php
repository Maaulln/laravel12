<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio')</title>

    {{-- Google Fonts for Retro Theme --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&family=Courier+Prime:wght@400;700&display=swap" rel="stylesheet">

    {{-- Portfolio Assets --}}
    @vite(['resources/css/portfolio.css', 'resources/js/portfolio.js'])
</head>
<body class="portfolio-page">

<div class="console-frame">

    {{-- Console Top Bar --}}
    <div class="console-top">
        <div class="console-brand">@yield('brand', 'PORTFOLIO.EXE v1.0')</div>
        <div class="led-indicator">
            <div class="led"></div>
            <span>ONLINE</span>
        </div>
        <div class="console-buttons">
            <div class="btn-circle red"></div>
            <div class="btn-circle amber"></div>
            <div class="btn-circle green"></div>
        </div>
    </div>

    {{-- Screen Bezel --}}
    <div class="screen-bezel">
        <div class="screen">
            @yield('content')
        </div>
    </div>

    {{-- Status Bar --}}
    <div class="status-bar" style="margin-top:12px">
        <span>
            HP:
            <div class="hp-bar">
                <div class="hp-pip"></div>
                <div class="hp-pip"></div>
                <div class="hp-pip"></div>
                <div class="hp-pip"></div>
                <div class="hp-pip"></div>
            </div>
        </span>
        <span>XP: @yield('xp', '2450 / 3000')</span>
        <span>LVL: @yield('level', '03')</span>
        <span id="clock">00:00:00</span>
    </div>

    {{-- Console Bottom Controls --}}
    <div class="console-bottom">
        <div class="dpad-section">

            {{-- D-Pad --}}
            <div class="dpad">
                <div class="dpad-btn empty"></div>
                <div class="dpad-btn">▲</div>
                <div class="dpad-btn empty"></div>
                <div class="dpad-btn">◀</div>
                <div class="dpad-btn center">●</div>
                <div class="dpad-btn">▶</div>
                <div class="dpad-btn empty"></div>
                <div class="dpad-btn">▼</div>
                <div class="dpad-btn empty"></div>
            </div>

            {{-- Speaker Grille --}}
            <div class="speaker-grille">
                @for($i = 0; $i < 16; $i++)
                    <div class="speaker-hole"></div>
                @endfor
            </div>

            {{-- Action Buttons --}}
            <div class="action-btns">
                <div class="action-btn x">X</div>
                <div class="action-btn y">Y</div>
                <div class="action-btn a">A</div>
                <div class="action-btn b">B</div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
