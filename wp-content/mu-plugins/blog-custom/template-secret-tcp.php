<?php
/**
 * Template Name: Secret TCP
 * Description: 隐藏的 TCP 连接演示页
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo("name"); ?> - Connection</title>
    <link rel="stylesheet" href="<?php echo content_url("/mu-plugins/blog-custom/css"); ?>/variables.css">
    <style>
        body,
        html {
            margin: 0 !important;
            padding: 0 !important;
        }

        body {
            min-height: 100vh;
            background:
                linear-gradient(90deg, rgba(17, 17, 17, 0.035) 1px, transparent 1px),
                linear-gradient(0deg, rgba(17, 17, 17, 0.035) 1px, transparent 1px),
                #ffffff;
            background-size: 48px 48px;
            color: #111111;
            overflow-x: hidden;
        }

        .tcp-page {
            min-height: 100vh;
            display: grid;
            grid-template-rows: auto 1fr auto;
            padding: 32px clamp(20px, 5vw, 72px);
        }

        .tcp-topbar,
        .tcp-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            font-family: var(--font-family);
            font-size: 12px;
            letter-spacing: 1.8px;
            color: rgba(17, 17, 17, 0.58);
        }

        .tcp-back {
            color: #111111;
            text-decoration: none;
            border-bottom: 1px solid rgba(17, 17, 17, 0.45);
            transition: color 180ms ease, border-color 180ms ease;
        }

        .tcp-back:hover,
        .tcp-back:focus-visible {
            color: #FF3333;
            border-color: #FF3333;
            outline: none;
        }

        .tcp-replay-btn {
            min-height: 34px;
            padding: 8px 14px;
            border: 1px solid rgba(17, 17, 17, 0.28);
            background: #ffffff;
            color: #111111;
            font-family: var(--font-family);
            font-size: 12px;
            letter-spacing: 1.8px;
            cursor: pointer;
            transition: border-color 180ms ease, color 180ms ease, background 180ms ease;
        }

        .tcp-replay-btn:hover,
        .tcp-replay-btn:focus-visible {
            border-color: #FF3333;
            color: #FF3333;
            outline: none;
        }

        .tcp-stage {
            width: min(1120px, 100%);
            margin: 0 auto;
            display: grid;
            align-content: center;
            gap: clamp(28px, 5vh, 56px);
            padding: clamp(34px, 7vh, 72px) 0;
        }

        .tcp-heading {
            display: grid;
            gap: 12px;
        }

        .tcp-kicker {
            font-family: var(--font-family);
            font-size: 12px;
            letter-spacing: 3px;
            color: #111111;
        }

        .tcp-title {
            margin: 0;
            max-width: 760px;
            font-size: clamp(38px, 7vw, 92px);
            line-height: 0.94;
            letter-spacing: 0;
            font-weight: 900;
            text-transform: uppercase;
        }

        .tcp-subtitle {
            max-width: 620px;
            margin: 0;
            color: rgba(17, 17, 17, 0.68);
            font-size: clamp(15px, 2vw, 18px);
            line-height: 1.8;
        }

        .tcp-subtitle span {
            display: block;
        }

        .tcp-link-layer {
            position: relative;
            min-height: 360px;
            display: grid;
            grid-template-columns: minmax(160px, 240px) 1fr minmax(160px, 240px);
            align-items: center;
            gap: clamp(18px, 4vw, 46px);
        }

        .tcp-node {
            position: relative;
            min-height: 220px;
            border: 1px solid rgba(17, 17, 17, 0.18);
            background: rgba(245, 245, 245, 0.78);
            display: grid;
            grid-template-rows: auto 1fr auto;
            align-content: center;
            justify-items: center;
            gap: 12px;
            padding: 24px;
            text-align: center;
        }

        .tcp-node::before,
        .tcp-node::after {
            content: "";
            position: absolute;
            width: 18px;
            height: 18px;
            border-color: #FFFA00;
            opacity: 0.8;
        }

        .tcp-node::before {
            top: -1px;
            left: -1px;
            border-top: 2px solid;
            border-left: 2px solid;
        }

        .tcp-node::after {
            right: -1px;
            bottom: -1px;
            border-right: 2px solid;
            border-bottom: 2px solid;
        }

        .tcp-node-label {
            font-family: var(--font-family);
            font-size: 12px;
            letter-spacing: 2px;
            color: #111111;
        }

        .tcp-person {
            position: relative;
            width: 116px;
            height: 116px;
            display: grid;
            place-items: center;
        }

        .tcp-person::before {
            content: "";
            position: absolute;
            inset: 0;
            border: 1px solid rgba(17, 17, 17, 0.12);
            border-radius: 50%;
            background: rgba(255, 250, 0, 0.16);
        }

        .tcp-person svg {
            position: relative;
            z-index: 1;
            width: 78px;
            height: 78px;
            color: #111111;
        }

        .tcp-node-status {
            min-height: 24px;
            font-family: var(--font-family);
            font-size: 13px;
            color: rgba(17, 17, 17, 0.62);
        }

        .tcp-line {
            position: relative;
            height: 240px;
            border-top: 1px solid rgba(17, 17, 17, 0.16);
            border-bottom: 1px solid rgba(17, 17, 17, 0.16);
            overflow: hidden;
            background:
                linear-gradient(90deg, rgba(255, 250, 0, 0.16), transparent 18%, transparent 82%, rgba(255, 51, 51, 0.1)),
                rgba(255, 255, 255, 0.56);
        }

        .tcp-line::before {
            content: "";
            position: absolute;
            inset: 50% 0 auto;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(17, 17, 17, 0.46), transparent);
            transform: translateY(-50%);
        }

        .tcp-line::after {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(90deg, transparent 0 32px, rgba(17, 17, 17, 0.05) 32px 34px);
        }

        .tcp-page.is-replaying .tcp-line::after {
            animation: tcp-scan 36s linear 1 forwards;
        }

        .tcp-ecg {
            position: absolute;
            inset: 34px 0 34px;
            z-index: 1;
            pointer-events: none;
            opacity: 0.78;
        }

        .tcp-ecg svg {
            width: 100%;
            height: 100%;
            display: block;
            overflow: visible;
        }

        .tcp-ecg path {
            fill: none;
            stroke: #FF3333;
            stroke-width: 1.8;
            stroke-linejoin: round;
            stroke-linecap: round;
            stroke-dasharray: 34 18 22 12 12 8 8 6 6 4 6 3 4 2;
            filter: drop-shadow(0 0 5px rgba(255, 51, 51, 0.2));
        }

        .tcp-page.is-replaying .tcp-ecg path {
            animation: ecg-flow 36s linear 1 forwards;
        }

        .tcp-heartbeat {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 24px;
            height: 24px;
            z-index: 3;
            color: #FF3333;
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.78);
            pointer-events: none;
        }

        .tcp-page.is-replaying .tcp-heartbeat {
            animation: heart-pace 36s linear 1 forwards;
        }

        .tcp-heartbeat svg {
            width: 100%;
            height: 100%;
            display: block;
            filter: drop-shadow(0 0 8px rgba(255, 51, 51, 0.3));
        }

        .tcp-heartbeat::after {
            content: "";
            position: absolute;
            inset: -8px;
            border: 1px solid rgba(255, 51, 51, 0.28);
            opacity: 0;
            transform: scale(0.7);
        }

        .tcp-page.is-replaying .tcp-heartbeat::after {
            animation: heart-ring 36s linear 1 forwards;
        }

        .tcp-packet {
            position: absolute;
            left: 0;
            top: var(--packet-y);
            transform: translate(-120%, -50%);
            min-width: 104px;
            padding: 8px 12px;
            border: 1px solid var(--packet-color);
            background: #ffffff;
            color: var(--packet-color);
            font-family: var(--font-family);
            font-size: 12px;
            letter-spacing: 1.2px;
            text-align: center;
            opacity: 0;
            z-index: 2;
        }

        .tcp-page.is-replaying .tcp-packet {
            animation: packet-right 24s linear 1 both;
            animation-delay: var(--packet-delay);
        }

        .tcp-packet.reverse {
            left: auto;
            right: 0;
            transform: translate(120%, -50%);
        }

        .tcp-page.is-replaying .tcp-packet.reverse:not(.reply) {
            animation-name: packet-left;
        }

        .tcp-packet.data {
            min-width: 176px;
            white-space: nowrap;
        }

        .tcp-packet.reply {
            left: 50%;
            right: auto;
            top: 50%;
            min-width: 232px;
            white-space: nowrap;
            transform: translate(64vw, -50%) scale(1);
            border-color: #333333;
            color: #333333;
            z-index: 4;
        }

        .tcp-page.is-replaying .tcp-packet.reply {
            animation: reply-focus 16s cubic-bezier(0.42, 0, 0.16, 1) 1 both;
            animation-delay: var(--packet-delay);
        }

        .tcp-log {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .tcp-log-item {
            min-height: 92px;
            border: 1px solid rgba(17, 17, 17, 0.16);
            padding: 16px;
            background: rgba(245, 245, 245, 0.72);
        }

        .tcp-page.is-replaying .tcp-log-item {
            animation: log-glow 6s linear 1 both;
            animation-delay: var(--log-delay);
        }

        .tcp-log-step {
            display: block;
            margin-bottom: 10px;
            font-family: var(--font-family);
            font-size: 11px;
            letter-spacing: 1.8px;
            color: #111111;
        }

        .tcp-log-text {
            display: grid;
            gap: 4px;
            margin: 0;
            color: rgba(17, 17, 17, 0.72);
            font-size: 14px;
            line-height: 1.6;
        }

        .tcp-log-text span {
            display: block;
        }

        .tcp-footer-note {
            margin-left: auto;
            color: rgba(255, 51, 51, 0.82);
        }

        @keyframes packet-right {
            0%, 8% { opacity: 0; transform: translate(-120%, -50%); }
            10%, 24% { opacity: 1; }
            28%, 100% { opacity: 0; transform: translate(calc(100vw + 120px), -50%); }
        }

        @keyframes packet-left {
            0%, 8% { opacity: 0; transform: translate(120%, -50%); }
            10%, 24% { opacity: 1; }
            28%, 100% { opacity: 0; transform: translate(calc(-100vw - 120px), -50%); }
        }

        @keyframes reply-focus {
            0%, 10% {
                opacity: 0;
                color: #333333;
                border-color: #333333;
                transform: translate(64vw, -50%) scale(1);
                box-shadow: none;
            }
            18% {
                opacity: 1;
                color: #333333;
                border-color: #333333;
                transform: translate(38vw, -50%) scale(1);
                box-shadow: none;
            }
            42% {
                opacity: 1;
                color: #FF3333;
                border-color: #FF3333;
                transform: translate(-50%, -50%) scale(1);
                box-shadow: 0 0 0 0 rgba(255, 51, 51, 0);
            }
            62% {
                opacity: 1;
                color: #FF3333;
                border-color: #FF3333;
                transform: translate(-50%, -50%) scale(1);
                box-shadow: 0 0 0 4px rgba(255, 51, 51, 0.08);
            }
            100% {
                opacity: 1;
                color: #FF3333;
                border-color: #FF3333;
                transform: translate(-50%, -50%) scale(1.22);
                box-shadow: 0 12px 30px rgba(255, 51, 51, 0.12);
            }
        }

        @keyframes tcp-scan {
            from { transform: translateX(0); }
            to { transform: translateX(220px); }
        }

        @keyframes ecg-flow {
            0% { stroke-dashoffset: 0; opacity: 0.34; }
            18% { stroke-dashoffset: -90; opacity: 0.46; }
            42% { stroke-dashoffset: -230; opacity: 0.58; }
            64% { stroke-dashoffset: -430; opacity: 0.74; }
            82% { stroke-dashoffset: -710; opacity: 0.9; }
            100% { stroke-dashoffset: -1080; opacity: 0.76; }
        }

        @keyframes heart-pace {
            0%, 7%, 14%, 24%, 31%, 41%, 48%, 57%, 63%, 70%, 76%, 81%, 86%, 90%, 94%, 98%, 100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.78);
            }
            3%, 20%, 37%, 54%, 67%, 79%, 88%, 96% {
                opacity: 0.92;
                transform: translate(-50%, -50%) scale(1.24);
            }
            4.5%, 21.5%, 38.5%, 55.5%, 68.5%, 80.5%, 89.5%, 97.5% {
                opacity: 0.52;
                transform: translate(-50%, -50%) scale(0.96);
            }
        }

        @keyframes heart-ring {
            0%, 7%, 14%, 24%, 31%, 41%, 48%, 57%, 63%, 70%, 76%, 81%, 86%, 90%, 94%, 98%, 100% {
                opacity: 0;
                transform: scale(0.7);
            }
            3%, 20%, 37%, 54%, 67%, 79%, 88%, 96% {
                opacity: 0.4;
                transform: scale(0.9);
            }
            6%, 23%, 40%, 57%, 70%, 82%, 91%, 99% {
                opacity: 0;
                transform: scale(1.65);
            }
        }

        @keyframes log-glow {
            0%, 14%, 100% {
                border-color: rgba(17, 17, 17, 0.16);
                box-shadow: none;
            }
            18%, 28% {
                border-color: rgba(255, 250, 0, 0.92);
                box-shadow: 0 0 0 4px rgba(255, 250, 0, 0.28);
            }
        }

        @media (max-width: 860px) {
            .tcp-page {
                padding: 22px;
            }

            .tcp-link-layer {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .tcp-node {
                min-height: 190px;
            }

            .tcp-line {
                height: 300px;
            }

            .tcp-ecg {
                inset: 52px 0;
            }

            .tcp-log {
                grid-template-columns: 1fr;
            }

            .tcp-topbar,
            .tcp-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .tcp-footer-note {
                margin-left: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 1ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
    <?php blog_custom_output_site_icon_links(); ?>
</head>
<body>
    <main class="tcp-page is-replaying" id="tcpPage">
        <header class="tcp-topbar">
            <a class="tcp-back" href="<?php echo home_url(); ?>">RETURN / HOME</a>
            <button class="tcp-replay-btn" id="tcpReplayButton" type="button" aria-label="Replay connection animation">重播</button>
        </header>

        <section class="tcp-stage" aria-label="TCP 建立连接过程">
            <div class="tcp-heading">
                <div class="tcp-kicker">PORT 520 / LISTENING</div>
                <h1 class="tcp-title">Connection Established</h1>
                <p class="tcp-subtitle">
                    <span>有些信息不会直接广播。</span>
                    <span>它先确认对方在线，再确认愿意接收，最后才把真正的内容交出去。</span>
                </p>
            </div>

            <div class="tcp-link-layer">
                <div class="tcp-node sender">
                    <div class="tcp-node-label">发送者</div>
                    <div class="tcp-person" aria-hidden="true">
                        <svg viewBox="0 0 96 96">
                            <circle cx="48" cy="27" r="14" fill="none" stroke="currentColor" stroke-width="4"/>
                            <path d="M25 78c3.8-18 14.6-28 23-28s19.2 10 23 28" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            <path d="M34 78h28" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="tcp-node-status">SENDER / SYN-SENT</div>
                </div>

                <div class="tcp-line" aria-hidden="true">
                    <div class="tcp-ecg">
                        <svg viewBox="0 0 600 120" preserveAspectRatio="none">
                            <path d="M0 64 H54 L66 64 L76 48 L88 78 L100 22 L116 92 L132 64 H190 L204 64 L216 52 L228 74 L240 34 L258 88 L272 64 H332 L346 64 L358 50 L370 76 L382 28 L400 92 L416 64 H474 L488 64 L500 54 L512 72 L524 40 L540 84 L556 64 H600" />
                        </svg>
                    </div>
                    <div class="tcp-heartbeat">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 20s-6.5-3.9-9-8.3C.8 7.8 3.1 4 6.7 4c2 0 3.4 1.1 4.2 2.3C11.7 5.1 13.1 4 15.1 4c3.6 0 5.9 3.8 3.7 7.7C16.5 16.1 12 20 12 20z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="tcp-packet" style="--packet-y: 30%; --packet-delay: 0s; --packet-color: #111111;">SYN</div>
                    <div class="tcp-packet reverse" style="--packet-y: 50%; --packet-delay: 6s; --packet-color: #333333;">SYN / ACK</div>
                    <div class="tcp-packet" style="--packet-y: 70%; --packet-delay: 12s; --packet-color: #111111;">ACK</div>
                    <div class="tcp-packet data" style="--packet-y: 42%; --packet-delay: 17.6s; --packet-color: #FF3333;">我想要了解你</div>
                    <div class="tcp-packet reverse reply" style="--packet-delay: 24s; --packet-color: #333333;">我也想更了解你一点</div>
                </div>

                <div class="tcp-node receiver">
                    <div class="tcp-node-label">接受者</div>
                    <div class="tcp-person" aria-hidden="true">
                        <svg viewBox="0 0 96 96">
                            <circle cx="48" cy="27" r="14" fill="none" stroke="currentColor" stroke-width="4"/>
                            <path d="M25 78c3.8-18 14.6-28 23-28s19.2 10 23 28" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                            <path d="M34 78h28" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="tcp-node-status">RECEIVER / ESTABLISHED</div>
                </div>
            </div>

            <div class="tcp-log" aria-label="连接日志">
                <div class="tcp-log-item" style="--log-delay: 0s;">
                    <span class="tcp-log-step">01 / SYN</span>
                    <p class="tcp-log-text">
                        <span>发送者发起连接请求。</span>
                        <span>状态进入 SYN-SENT。</span>
                    </p>
                </div>
                <div class="tcp-log-item" style="--log-delay: 6s;">
                    <span class="tcp-log-step">02 / SYN-ACK</span>
                    <p class="tcp-log-text">
                        <span>接收者确认请求。</span>
                        <span>返回 SYN-ACK 响应。</span>
                    </p>
                </div>
                <div class="tcp-log-item" style="--log-delay: 12s;">
                    <span class="tcp-log-step">03 / ACK</span>
                    <p class="tcp-log-text">
                        <span>发送者确认响应。</span>
                        <span>连接状态建立完成。</span>
                    </p>
                </div>
                <div class="tcp-log-item" style="--log-delay: 17.6s;">
                    <span class="tcp-log-step">04 / DATA</span>
                    <p class="tcp-log-text">
                        <span>发送者传输数据。</span>
                        <span>载荷：我想要了解你。</span>
                    </p>
                </div>
                <div class="tcp-log-item" style="--log-delay: 20.4s;">
                    <span class="tcp-log-step">05 / REPLY</span>
                    <p class="tcp-log-text">
                        <span>接收者返回数据。</span>
                        <span>载荷：我也想更了解你一点。</span>
                    </p>
                </div>
            </div>
        </section>

        <footer class="tcp-footer">
            <span>STATE: ESTABLISHED</span>
            <span class="tcp-footer-note">payload accepted quietly</span>
        </footer>
    </main>
    <script>
        (function() {
            var page = document.getElementById('tcpPage');
            var replayButton = document.getElementById('tcpReplayButton');

            if (!page || !replayButton) {
                return;
            }

            replayButton.addEventListener('click', function() {
                page.classList.remove('is-replaying');
                void page.offsetWidth;
                page.classList.add('is-replaying');
            });
        })();
    </script>
</body>
</html>
