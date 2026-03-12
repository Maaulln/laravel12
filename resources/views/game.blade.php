{{--
    Game Page – Snake.EXE
    Retro Game Console Theme
--}}
@extends('layouts.portfolio')

@section('title', 'Snake.EXE – Maulana Chandra Irawan')
@section('brand', 'SNAKE.EXE v1.0')
@section('xp', '??? / MAX')
@section('level', '??')

@section('content')
    {{-- Game Header --}}
    <div class="section-header">
        <span>🐍 SNAKE.EXE – ARCADE MODE</span>
    </div>

    {{-- Back Button --}}
    <div style="margin-bottom: 16px;">
        <a href="{{ url('/') }}" style="
            font-family: 'Press Start 2P', monospace;
            font-size: 8px;
            color: var(--brown-light);
            text-decoration: none;
            border: 2px solid var(--brown-warm);
            padding: 8px 14px;
            display: inline-block;
            transition: all 0.1s;
        " onmouseover="this.style.color='var(--accent-amber)';this.style.borderColor='var(--accent-amber)'"
           onmouseout="this.style.color='var(--brown-light)';this.style.borderColor='var(--brown-warm)'">
            ◀ BACK TO HOME
        </a>
    </div>

    {{-- Game Container --}}
    <div class="game-container">

        {{-- Score Bar --}}
        <div class="game-info-bar">
            <div class="game-stat-box">
                <div class="game-stat-label">SCORE</div>
                <div class="game-stat-value" id="score">0</div>
            </div>
            <div class="game-stat-box">
                <div class="game-stat-label">BEST</div>
                <div class="game-stat-value" id="high-score">0</div>
            </div>
            <div class="game-stat-box">
                <div class="game-stat-label">LEVEL</div>
                <div class="game-stat-value" id="level-display">1</div>
            </div>
        </div>

        {{-- Canvas --}}
        <div class="game-canvas-wrapper">
            <canvas id="snake-canvas" width="420" height="420"></canvas>

            <div id="game-overlay" class="game-overlay">
                <div class="overlay-content">
                    <div class="overlay-title" id="overlay-title">SNAKE.EXE</div>
                    <div class="overlay-subtitle" id="overlay-subtitle">PRESS ENTER / BTN-A TO START</div>
                    <div class="overlay-score" id="overlay-score" style="display:none;"></div>
                </div>
            </div>
        </div>

        {{-- Controls Hint --}}
        <div class="game-controls-hint">
            <span>↑↓←→ / WASD : MOVE</span>
            <span>ENTER / BTN-A : START</span>
            <span>P / BTN-B : PAUSE</span>
            <span>D-PAD : STEER</span>
        </div>

    </div>

    {{-- How to Play Terminal Box --}}
    <div class="terminal-box" style="margin-top: 28px;">
        <div class="terminal-header">
            <span class="terminal-dot red"></span>
            <span class="terminal-dot yellow"></span>
            <span class="terminal-dot green"></span>
            <span class="terminal-title">snake@console:~</span>
        </div>
        <div class="terminal-content">
            <p><span class="prompt">$</span> cat HOW_TO_PLAY.txt</p>
            <p class="response">► Gunakan ARROW KEYS / WASD / D-PAD untuk bergerak.</p>
            <p class="response">► Makan makanan (🔴) untuk menambah skor (+10 poin).</p>
            <p class="response">► Setiap 50 poin naik level, kecepatan meningkat.</p>
            <p class="response">► Game over jika menabrak dinding atau tubuh sendiri.</p>
            <p class="response">► Skor tertinggi tersimpan otomatis di browser.</p>
            <p><span class="prompt">$</span> <span class="cursor-blink">_</span></p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // ── Config ──────────────────────────────────────────────
    const CANVAS_SIZE = 420;
    const GRID        = 21;        // cell size in px
    const COLS        = CANVAS_SIZE / GRID; // 20 cols
    const ROWS        = CANVAS_SIZE / GRID; // 20 rows
    const BASE_SPEED  = 160;       // ms per step
    const MIN_SPEED   = 65;
    const SPEED_STEP  = 15;        // ms faster per level

    // Retro palette
    const C = {
        bg:        '#0d0804',
        grid:      'rgba(232,160,32,0.04)',
        snakeHead: '#ffd060',
        snakeBody: '#e8a020',
        food:      '#c0392b',
        foodGlow:  'rgba(192,57,43,0.7)',
        border:    '#8b5e3c',
    };

    // ── State ────────────────────────────────────────────────
    let snake, dir, nextDir, food, score, highScore, level, speed;
    let gameState = 'idle';   // idle | running | paused | over
    let loopTimer = null;

    // ── DOM Refs ─────────────────────────────────────────────
    const canvas      = document.getElementById('snake-canvas');
    const ctx         = canvas.getContext('2d');
    const elScore     = document.getElementById('score');
    const elBest      = document.getElementById('high-score');
    const elLevel     = document.getElementById('level-display');
    const elOverlay   = document.getElementById('game-overlay');
    const elTitle     = document.getElementById('overlay-title');
    const elSubtitle  = document.getElementById('overlay-subtitle');
    const elOvScore   = document.getElementById('overlay-score');

    // ── Helpers ──────────────────────────────────────────────
    function rand(max) { return Math.floor(Math.random() * max); }

    function spawnFood() {
        let pos;
        do { pos = { x: rand(COLS), y: rand(ROWS) }; }
        while (snake.some(s => s.x === pos.x && s.y === pos.y));
        return pos;
    }

    function resetState() {
        const cx = Math.floor(COLS / 2);
        const cy = Math.floor(ROWS / 2);
        snake    = [{ x: cx, y: cy }, { x: cx - 1, y: cy }, { x: cx - 2, y: cy }];
        dir      = { x: 1, y: 0 };
        nextDir  = { x: 1, y: 0 };
        food     = spawnFood();
        score    = 0;
        level    = 1;
        speed    = BASE_SPEED;
        elScore.textContent       = 0;
        elLevel.textContent       = 1;
    }

    // ── Game Loop ─────────────────────────────────────────────
    function startLoop() {
        stopLoop();
        loopTimer = setInterval(tick, speed);
    }

    function stopLoop() {
        if (loopTimer) { clearInterval(loopTimer); loopTimer = null; }
    }

    function tick() {
        dir = { ...nextDir };

        const head = { x: snake[0].x + dir.x, y: snake[0].y + dir.y };

        // Wall collision
        if (head.x < 0 || head.x >= COLS || head.y < 0 || head.y >= ROWS) {
            triggerGameOver(); return;
        }
        // Self collision
        if (snake.some(s => s.x === head.x && s.y === head.y)) {
            triggerGameOver(); return;
        }

        snake.unshift(head);

        if (head.x === food.x && head.y === food.y) {
            // Ate food
            score += 10;
            elScore.textContent = score;

            if (score > highScore) {
                highScore = score;
                localStorage.setItem('snakeHighScore', highScore);
                elBest.textContent = highScore;
            }

            food = spawnFood();

            // Level up every 50 points
            const newLevel = Math.floor(score / 50) + 1;
            if (newLevel > level) {
                level = newLevel;
                speed = Math.max(MIN_SPEED, BASE_SPEED - (level - 1) * SPEED_STEP);
                elLevel.textContent = level;
                startLoop(); // restart with new speed
            }
        } else {
            snake.pop();
        }

        draw();
    }

    // ── Drawing ───────────────────────────────────────────────
    function draw() {
        // Background
        ctx.fillStyle = C.bg;
        ctx.fillRect(0, 0, CANVAS_SIZE, CANVAS_SIZE);

        // Grid lines
        ctx.strokeStyle = C.grid;
        ctx.lineWidth   = 0.5;
        for (let i = 0; i <= COLS; i++) {
            ctx.beginPath(); ctx.moveTo(i * GRID, 0); ctx.lineTo(i * GRID, CANVAS_SIZE); ctx.stroke();
        }
        for (let j = 0; j <= ROWS; j++) {
            ctx.beginPath(); ctx.moveTo(0, j * GRID); ctx.lineTo(CANVAS_SIZE, j * GRID); ctx.stroke();
        }

        // Food with glow
        ctx.save();
        ctx.shadowColor = C.foodGlow;
        ctx.shadowBlur  = 14;
        ctx.fillStyle   = C.food;
        ctx.fillRect(food.x * GRID + 3, food.y * GRID + 3, GRID - 6, GRID - 6);
        ctx.restore();

        // Snake
        snake.forEach((seg, i) => {
            ctx.save();
            if (i === 0) {
                ctx.shadowColor = 'rgba(232,160,32,0.9)';
                ctx.shadowBlur  = 12;
                ctx.fillStyle   = C.snakeHead;
            } else {
                const alpha = Math.max(0.35, 1 - (i / snake.length) * 0.65);
                ctx.fillStyle = `rgba(232,160,32,${alpha.toFixed(2)})`;
                ctx.shadowBlur = 0;
            }
            ctx.fillRect(seg.x * GRID + 1, seg.y * GRID + 1, GRID - 2, GRID - 2);
            ctx.restore();
        });
    }

    // ── Overlay Helpers ───────────────────────────────────────
    function showOverlay(title, subtitle, scoreLine) {
        elTitle.textContent    = title;
        elSubtitle.textContent = subtitle;
        if (scoreLine) {
            elOvScore.textContent  = scoreLine;
            elOvScore.style.display = 'block';
        } else {
            elOvScore.style.display = 'none';
        }
        elOverlay.style.display = 'flex';
    }

    function hideOverlay() {
        elOverlay.style.display = 'none';
    }

    // ── Actions ───────────────────────────────────────────────
    function startGame() {
        resetState();
        gameState = 'running';
        hideOverlay();
        startLoop();
        draw();

        // Signal game is active so portfolio.js keyboard nav is suppressed
        window.snakeGameActive = true;
    }

    function pauseGame() {
        if (gameState === 'running') {
            gameState = 'paused';
            stopLoop();
            showOverlay('PAUSED', 'PRESS P / BTN-B TO RESUME', null);
        } else if (gameState === 'paused') {
            gameState = 'running';
            hideOverlay();
            startLoop();
        }
    }

    function triggerGameOver() {
        gameState = 'over';
        stopLoop();
        window.snakeGameActive = false;
        draw();
        showOverlay('GAME OVER', 'PRESS ENTER / BTN-A TO RETRY', 'SCORE: ' + score);
    }

    // ── Keyboard Controls ─────────────────────────────────────
    document.addEventListener('keydown', function (e) {
        switch (e.key) {
            case 'ArrowUp':
            case 'w': case 'W':
                if (gameState === 'running' && dir.y !== 1) nextDir = { x: 0, y: -1 };
                e.stopPropagation(); e.preventDefault(); break;

            case 'ArrowDown':
            case 's': case 'S':
                if (gameState === 'running' && dir.y !== -1) nextDir = { x: 0, y: 1 };
                e.stopPropagation(); e.preventDefault(); break;

            case 'ArrowLeft':
            case 'a': case 'A':
                if (gameState === 'running' && dir.x !== 1) nextDir = { x: -1, y: 0 };
                e.stopPropagation(); e.preventDefault(); break;

            case 'ArrowRight':
            case 'd': case 'D':
                if (gameState === 'running' && dir.x !== -1) nextDir = { x: 1, y: 0 };
                e.stopPropagation(); e.preventDefault(); break;

            case 'Enter':
                if (gameState !== 'running') startGame();
                e.preventDefault(); break;

            case 'p': case 'P':
                if (gameState === 'running' || gameState === 'paused') pauseGame();
                e.preventDefault(); break;
        }
    }, true); // capture phase – runs before portfolio.js bubble phase

    // ── D-Pad & Button Controls ───────────────────────────────
    document.querySelectorAll('.dpad-btn').forEach(function (btn) {
        const txt = btn.textContent.trim();

        if (txt === '▲') {
            btn.addEventListener('click', function () {
                if (gameState === 'running' && dir.y !== 1) nextDir = { x: 0, y: -1 };
            });
        } else if (txt === '▼') {
            btn.addEventListener('click', function () {
                if (gameState === 'running' && dir.y !== -1) nextDir = { x: 0, y: 1 };
            });
        } else if (txt === '◀') {
            btn.addEventListener('click', function () {
                if (gameState === 'running' && dir.x !== 1) nextDir = { x: -1, y: 0 };
            });
        } else if (txt === '▶') {
            btn.addEventListener('click', function () {
                if (gameState === 'running' && dir.x !== -1) nextDir = { x: 1, y: 0 };
            });
        } else if (txt === '●') {
            btn.addEventListener('click', function () {
                if (gameState !== 'running') startGame();
                else pauseGame();
            });
        }
    });

    document.querySelectorAll('.action-btn').forEach(function (btn) {
        if (btn.classList.contains('a')) {
            btn.addEventListener('click', function () {
                if (gameState !== 'running') startGame();
            });
        }
        if (btn.classList.contains('b')) {
            btn.addEventListener('click', pauseGame);
        }
        if (btn.classList.contains('x')) {
            btn.addEventListener('click', function () {
                if (gameState !== 'running') startGame();
            });
        }
    });

    // ── Init ──────────────────────────────────────────────────
    highScore = parseInt(localStorage.getItem('snakeHighScore') || '0', 10);
    elBest.textContent = highScore;

    resetState();
    draw();
    showOverlay('SNAKE.EXE', 'PRESS ENTER / BTN-A TO START', null);

})();
</script>
@endpush
