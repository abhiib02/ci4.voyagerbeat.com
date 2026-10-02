<style>
    /* ---- Loader ---- */
    #form-loader {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(15, 23, 42, .65);
        backdrop-filter: blur(3px);
    }

    #form-loader.show {
        display: flex;
    }

    #form-loader .box {
        background: #fff;
        border-radius: 12px;
        padding: 28px 36px;
        min-width: 280px;
        max-width: 90vw;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0, 0, 0, .25);
    }

    #form-loader .spinner {
        width: 48px;
        height: 48px;
        margin: 0 auto 16px;
        border: 4px solid #e2e8f0;
        border-top-color: #2563eb;
        border-radius: 50%;
        animation: fl-spin .8s linear infinite;
    }

    #form-loader h4 {
        margin: 0 0 6px;
        font-size: 18px;
    }

    #form-loader p {
        margin: 0;
        font-size: 14px;
        color: #64748b;
        min-height: 20px;
    }

    #form-loader small {
        display: block;
        margin-top: 12px;
        color: #94a3b8;
        font-size: 12px;
    }

    @keyframes fl-spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
<!-- Loader markup -->
<div id="form-loader" role="alert" aria-live="polite">
    <div class="box">
        <div class="spinner"></div>
        <h4 id="fl-title">Please wait...</h4>
        <p id="fl-message"></p>
        <small>Please don't close or refresh this page.</small>
    </div>
</div>