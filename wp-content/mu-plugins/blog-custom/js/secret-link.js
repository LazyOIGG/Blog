// ==================== About 隐藏入口 ====================
(function () {
    const trigger = document.getElementById('secretHeartTrigger');
    if (!trigger) {
        return;
    }

    const requiredClicks = 5;
    const passphrase = '丁瑜';
    const aboutUrl = trigger.dataset.aboutUrl || '/?section=about';
    const secretUrl = trigger.dataset.secretUrl || '/?section=secret';
    let clickCount = 0;
    let resetTimer = null;

    function createDialog() {
        const dialog = document.createElement('dialog');
        dialog.className = 'secret-dialog';
        dialog.innerHTML = [
            '<form method="dialog" class="secret-dialog-form" id="secretDialogForm">',
            '    <label class="secret-dialog-label">',
            '        <span>CONNECTION REQUEST</span>',
            '        <input class="secret-dialog-input" id="secretDialogInput" type="text" placeholder="你真的想要了解我吗？" autocomplete="off">',
            '    </label>',
            '    <div class="secret-dialog-actions">',
            '        <button class="secret-dialog-btn" value="cancel" type="button" data-secret-cancel>取消</button>',
            '        <button class="secret-dialog-btn primary" value="confirm" type="submit">确认</button>',
            '    </div>',
            '</form>'
        ].join('');
        document.body.appendChild(dialog);
        return dialog;
    }

    const dialog = createDialog();
    const form = dialog.querySelector('#secretDialogForm');
    const input = dialog.querySelector('#secretDialogInput');
    const cancelButton = dialog.querySelector('[data-secret-cancel]');
    const supportsDialog = typeof dialog.showModal === 'function';

    if (!supportsDialog) {
        dialog.classList.add('is-fallback');
    }

    function resetClicks() {
        clickCount = 0;
        trigger.removeAttribute('data-count');
    }

    function openDialog() {
        resetClicks();
        input.value = '';

        if (supportsDialog) {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
        }

        window.setTimeout(() => input.focus(), 30);
    }

    function closeDialog() {
        if (supportsDialog && dialog.open) {
            dialog.close();
        } else {
            dialog.removeAttribute('open');
        }
    }

    function goByInputValue() {
        const value = input.value.trim();
        window.location.href = value === passphrase ? secretUrl : aboutUrl;
    }

    trigger.addEventListener('click', () => {
        clickCount += 1;
        trigger.dataset.count = String(clickCount);
        trigger.classList.remove('is-counting');
        void trigger.offsetWidth;
        trigger.classList.add('is-counting');

        window.clearTimeout(resetTimer);
        resetTimer = window.setTimeout(resetClicks, 2600);

        if (clickCount >= requiredClicks) {
            window.clearTimeout(resetTimer);
            openDialog();
        }
    });

    trigger.addEventListener('animationend', () => {
        trigger.classList.remove('is-counting');
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        goByInputValue();
    });

    cancelButton.addEventListener('click', closeDialog);

    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) {
            closeDialog();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && dialog.hasAttribute('open')) {
            closeDialog();
        }
    });
})();
