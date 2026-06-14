{{--
    Shared dropdown styling for the suite. Any <select class="js-select"> on the
    page is upgraded to TomSelect with one consistent, brand-themed look (search,
    tags for multi-selects, keyboard nav). Include this partial once per page that
    has dropdowns. Themed with the app's --color-brand-* CSS variables so it
    matches each SaaS automatically.
--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/css/tom-select.min.css">
<style>
    .ts-wrapper { margin-top: 0.25rem; }
    .ts-control {
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 0.45rem 0.65rem;
        min-height: 42px;
        box-shadow: none;
        font-size: 0.875rem;
        background-color: #fff;
    }
    .ts-wrapper.focus .ts-control,
    .ts-control:focus-within {
        border-color: var(--color-brand-500, #6366f1);
        box-shadow: 0 0 0 1px var(--color-brand-500, #6366f1);
        outline: none;
    }
    .ts-wrapper.multi .ts-control > .item {
        background: var(--color-brand-50, #eef2ff);
        color: var(--color-brand-700, #4338ca);
        border: 1px solid var(--color-brand-200, #c7d2fe);
        border-radius: 0.375rem;
        font-weight: 500;
    }
    .ts-wrapper.multi .ts-control > .item .remove { border-left-color: var(--color-brand-200, #c7d2fe); }
    .ts-dropdown {
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,.12);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .ts-dropdown .active { background: var(--color-brand-50, #eef2ff); color: var(--color-brand-700, #4338ca); }
    .ts-dropdown .option.selected { color: var(--color-brand-700, #4338ca); }

    /* Dark mode */
    .dark .ts-control { background-color: #111827; border-color: #374151; color: #f3f4f6; }
    .dark .ts-control input { color: #f3f4f6; }
    .dark .ts-wrapper.multi .ts-control > .item { background: rgba(99,102,241,.18); color: #c7d2fe; border-color: rgba(99,102,241,.35); }
    .dark .ts-dropdown { background: #1f2937; border-color: #374151; color: #f3f4f6; }
    .dark .ts-dropdown .active { background: rgba(99,102,241,.18); color: #e0e7ff; }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.3.1/js/tom-select.complete.min.js"></script>
<script>
    (function () {
        function initTomSelects() {
            if (typeof TomSelect === 'undefined') return;
            document.querySelectorAll('select.js-select:not([data-ts-init])').forEach(function (el) {
                el.dataset.tsInit = '1';
                new TomSelect(el, {
                    plugins: el.multiple ? ['remove_button'] : [],
                    persist: false,
                    maxOptions: null,
                    hideSelected: false,
                    placeholder: el.getAttribute('data-placeholder') || (el.multiple ? 'Select…' : ''),
                    onChange: function () { el.dispatchEvent(new Event('change', { bubbles: true })); },
                    // Clear the typed query after a pick (TomSelect keeps it by
                    // default in multi mode) and re-filter so the list resets.
                    onItemAdd: function () {
                        this.setTextboxValue('');
                        this.refreshOptions(false);
                    },
                });
            });
        }
        if (document.readyState !== 'loading') initTomSelects();
        else document.addEventListener('DOMContentLoaded', initTomSelects);
    })();
</script>
