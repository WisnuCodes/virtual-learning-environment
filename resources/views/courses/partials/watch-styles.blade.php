<style>
    /* Premium Modern Layout - NeoBrutalism */
    .watch-container {
        --bg-body: var(--bg-secondary, #f8fafc);
        --bg-panel: #ffffff;
        --bg-hover: #f1f5f9;
        --bg-sec: var(--bg-hover);
        --border-color: #000000;
        --text-prim: #0f172a;
        --text-sec: #475569;
        --accent: #10b981;
        --accent-hover: #059669;
        --accent-light: #ecfdf5;
        --radius: 0px;
        --radius-sm: 0px;
        --radius-full: 0px;
        --shadow-sm: 2px 2px 0px 0px var(--text-prim);
        --shadow: 4px 4px 0px 0px var(--accent);
        --shadow-md: 6px 6px 0px 0px var(--accent);
        --shadow-lg: 8px 8px 0px 0px var(--accent);
    }

    .watch-container,
    .watch-container *,
    .watch-container input,
    .watch-container button,
    .watch-container textarea,
    .watch-container img {
        border-radius: 0px !important;
    }

    .watch-container * {
        box-sizing: border-box;
    }

    .watch-layout {
        display: flex;
        height: calc(100vh - 73px);
        overflow: hidden;
        background: var(--bg-body);
        font-family: "Poppins", sans-serif;
    }

    .video-player-area {
        flex: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        background: var(--bg-body);
        scroll-behavior: smooth;
    }

    .playlist-sidebar-area {
        width: 380px;
        background: var(--bg-panel);
        border-left: 2px solid var(--text-prim);
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        overflow-y: auto;
        z-index: 10;
    }

    /* Video player */
    .video-player-area>div:first-child {
        background: #000 !important;
        border-bottom: 2px solid var(--text-prim);
        z-index: 5;
    }

    #course-video {
        border-radius: 0;
    }

    .video-info {
        padding: 40px 5%;
        flex: 1;
        background-color: var(--bg-secondary, #f8fafc);
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 24px 24px;
    }

    .video-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-prim);
        margin-bottom: 12px;
        line-height: 1.3;
        letter-spacing: -0.5px;
        text-transform: uppercase;
    }

    .video-meta {
        color: var(--text-sec);
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 35px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .meta-badge {
        background: var(--bg-panel);
        border: 2px solid var(--text-prim);
        padding: 6px 14px;
        border-radius: 0;
        color: var(--text-prim);
        font-weight: 800;
        font-size: 13px;
        display: flex;
        align-items: center;
        box-shadow: 2px 2px 0px 0px var(--accent);
        text-transform: uppercase;
    }

    /* Buttons */
    .btn-sq-primary {
        background: var(--accent);
        color: #ffffff;
        border: 2px solid var(--text-prim);
        padding: 10px 20px;
        border-radius: 0;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px 0px var(--text-prim);
    }

    .btn-sq-primary:hover {
        background: var(--accent);
        color: #ffffff;
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px var(--text-prim);
    }

    .btn-sq-primary:active {
        transform: translate(2px, 2px);
        box-shadow: 0px 0px 0px 0px var(--text-prim);
    }

    .btn-sq-outline {
        background: var(--bg-panel);
        color: var(--text-prim);
        border: 2px solid var(--text-prim);
        padding: 10px 20px;
        border-radius: 0;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 4px 4px 0px 0px var(--accent);
    }

    .btn-sq-outline:hover {
        background: var(--bg-hover);
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px var(--accent);
    }

    .btn-sq-outline:active {
        transform: translate(2px, 2px);
        box-shadow: 0px 0px 0px 0px var(--accent);
    }

    /* Forms */
    .form-control-sq {
        width: 100%;
        padding: 14px 18px;
        font-size: 14px;
        border: 2px solid var(--text-prim);
        border-radius: 0;
        outline: none;
        transition: all 0.2s ease;
        background: var(--bg-panel);
        color: var(--text-prim);
        font-family: inherit;
        font-weight: 500;
        box-shadow: inset 2px 2px 0px 0px rgba(0, 0, 0, 0.05);
    }

    .form-control-sq:focus {
        border-color: var(--accent);
        box-shadow: 4px 4px 0px 0px var(--accent);
    }

    /* Tabs */
    .content-box {
        background: var(--bg-panel);
        border-radius: 0;
        margin-bottom: 40px;
        box-shadow: 8px 8px 0px 0px var(--accent);
        overflow: hidden;
        border: 2px solid var(--text-prim);
        max-width: 100%;
    }

    .tab-container {
        display: flex;
        border-bottom: 2px solid var(--text-prim);
        background: var(--bg-panel);
        overflow-x: auto;
        padding: 0;
        gap: 0;
        scrollbar-width: none;
        max-width: 100%;
    }

    .tab-container::-webkit-scrollbar {
        display: none;
    }

    .tab-btn {
        flex: 1;
        flex-shrink: 0;
        padding: 16px 20px;
        background: transparent;
        border: none;
        font-weight: 800;
        font-size: 13px;
        cursor: pointer;
        color: var(--text-sec);
        transition: all 0.2s ease;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 3px solid transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-right: 2px solid var(--text-prim);
    }
    
    .tab-btn:last-child {
        border-right: none;
    }

    .tab-btn:hover {
        background: var(--bg-hover);
        color: var(--text-prim);
    }

    .tab-btn.active {
        background: #ffffff;
        color: var(--text-prim);
        border-bottom-color: var(--accent);
    }

    .tab-pane {
        padding: 35px;
        display: none;
        background: var(--bg-panel);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .tab-pane.active {
        display: block;
    }

    .pane-title {
        margin-bottom: 25px;
        color: var(--text-prim);
        font-size: 18px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--text-prim);
        text-transform: uppercase;
    }

    .pane-desc {
        font-size: 15px;
        color: var(--text-sec);
        line-height: 1.8;
    }

    /* Alerts */
    .alert-sq-success,
    .alert-sq-error {
        padding: 14px 20px;
        border-radius: 0;
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 2px solid;
    }

    .alert-sq-success {
        background: #ecfdf5;
        border-color: #10b981;
        color: #065f46;
        box-shadow: 4px 4px 0px 0px #10b981;
    }

    .alert-sq-error {
        background: #fef2f2;
        border-color: #ef4444;
        color: #991b1b;
        box-shadow: 4px 4px 0px 0px #ef4444;
    }

    .sq-badge {
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 800;
        border-radius: 0;
        background: var(--bg-hover);
        color: var(--text-prim);
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 2px solid var(--text-prim);
        text-transform: uppercase;
    }

    /* Items/Cards */
    .item-card {
        border: 2px solid var(--text-prim);
        background: var(--bg-panel);
        border-radius: 0;
        margin-bottom: 20px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        box-shadow: 4px 4px 0px 0px var(--accent);
    }

    .item-card:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0px 0px var(--accent);
    }

    .item-header {
        padding: 18px 24px;
        background: var(--bg-hover);
        border-bottom: 2px solid var(--text-prim);
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .item-body {
        padding: 24px;
    }

    /* Avatars */
    .avatar-sq {
        width: 48px;
        height: 48px;
        background: var(--accent);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        flex-shrink: 0;
        border-radius: 0;
        border: 2px solid var(--text-prim);
    }

    .avatar-inst {
        background: var(--text-prim);
        color: #fff;
    }

    .avatar-sm {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }

    /* Comments */
    .reply-box {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px dashed var(--text-prim);
    }

    .reply-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
    }

    .reply-content {
        flex: 1;
        background: var(--bg-hover);
        border-radius: 0;
        padding: 16px 20px;
        position: relative;
        border: 2px solid var(--border-color);
        box-shadow: 2px 2px 0px 0px var(--text-prim);
    }

    .reply-content.is-inst {
        background: var(--accent-light);
        border-color: var(--accent);
    }

    /* Custom radio */
    .radio-sq {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        padding: 16px 20px;
        background: var(--bg-panel);
        border: 2px solid var(--text-prim);
        border-radius: 0;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 12px;
        box-shadow: 2px 2px 0px 0px var(--text-prim);
    }

    .radio-sq:hover {
        border-color: var(--accent);
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0px 0px var(--text-prim);
    }

    .radio-sq input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent);
    }

    /* Sidebar */
    .playlist-header {
        padding: 24px;
        background: #ffffff;
        border-bottom: 2px solid var(--text-prim);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .playlist-section-title {
        padding: 14px 24px;
        background: var(--bg-hover);
        font-weight: 800;
        font-size: 13px;
        color: var(--text-sec);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: sticky;
        top: 96px;
        z-index: 9;
        border-bottom: 2px solid var(--text-prim);
        border-top: 2px solid var(--text-prim);
        margin-top: -2px;
    }

    .playlist-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 24px;
        border-bottom: 2px solid var(--text-prim);
        cursor: pointer;
        transition: all 0.2s ease;
        background: var(--bg-panel);
        font-weight: 600;
    }

    .playlist-item.active {
        background: var(--accent);
        color: #fff;
    }

    .playlist-item:hover:not(.active) {
        background: var(--bg-hover);
    }

    .playlist-item.active .text-sec {
        color: #fff !important;
    }

    /* Utility */
    .text-danger {
        color: #ef4444 !important;
    }

    .bg-danger-light {
        background: #fef2f2 !important;
        border-color: #ef4444 !important;
    }

    .text-success {
        color: #10b981 !important;
    }

    .bg-success-light {
        background: #ecfdf5 !important;
        border-color: #10b981 !important;
        color: #065f46;
    }

    .text-warning {
        color: #f59e0b !important;
    }

    .bg-warning-light {
        background: #fffbeb !important;
        border-color: #f59e0b !important;
    }

    /* Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-body);
        border-left: 1px solid var(--text-prim);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--text-prim);
        border-radius: 0;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--accent);
    }

    @media (max-width: 992px) {
        .watch-layout {
            flex-direction: column;
            height: auto;
            overflow: visible;
        }

        .video-player-area {
            overflow-y: visible;
        }

        .playlist-sidebar-area {
            width: 100%;
            border-left: none;
            border-top: 2px solid var(--text-prim);
        }
    }

    @media (max-width: 768px) {
        .video-info {
            padding: 20px 15px;
        }

        .video-title {
            font-size: 22px;
        }

        .video-meta {
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tab-btn {
        flex: none; /* Disable flex: 1 on mobile to prevent squishing */
        padding: 14px 16px;
        font-size: 13px;
    }

        .tab-pane {
            padding: 20px 15px;
        }

        .pane-title {
            font-size: 16px;
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .pane-title .btn-sq-primary {
            width: 100%;
        }

        .item-header {
            flex-direction: column;
            gap: 15px;
        }

        .item-header .btn-sq-outline {
            width: 100%;
        }
    }

    /* Sticky fixes for mobile */
    .quiz-timer-bar {
        top: 0;
    }

    @media (max-width: 992px) {
        .quiz-timer-bar {
            top: 73px !important;
        }

        .playlist-header {
            top: 0 !important;
        }

        .playlist-section-title {
            top: 77px !important;
        }
    }
    /* Submission Info */
    .submission-info-container {
        margin-bottom: 30px;
    }

    .submission-info-title {
        font-size: 16px;
        font-weight: 800;
        color: var(--text-prim);
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .submission-info-box {
        background: #ffffff;
        border: 2px solid var(--text-prim);
        overflow: hidden;
    }

    .submission-info-row {
        display: flex;
        align-items: center;
        padding: 18px 25px;
        border-bottom: 2px solid var(--bg-hover);
        gap: 20px;
    }

    .submission-info-row:last-child {
        border-bottom: none;
    }

    .submission-info-label {
        flex: 0 0 200px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-sec);
    }

    .submission-info-value {
        flex: 1;
        font-size: 14px;
        font-weight: 800;
        color: var(--text-prim);
        text-align: right;
    }

    .deadline-badge {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fdba74;
        padding: 6px 16px;
        border-radius: 50px !important;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }
</style>
