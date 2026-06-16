{{--
    Shared DataTables control styling for the suite. Brand-styles the
    "Show entries" length dropdown + "Search" input (and info/pagination) so an
    admin DataTable grid matches the app's form inputs. Themed with each app's
    --color-brand-* CSS variables so it retheme's automatically.

    Usage: the app shell already loads jquery.dataTables.min.css/js; include this
    partial once (or paste the <style> into layouts/app.blade.php next to the
    DataTables stylesheet). Mirrors the CSS shown in the ssuite-ui style guide.
--}}
<style>
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter { margin-bottom: 1rem; font-size: .875rem; color: #6b7280; }
    .dataTables_wrapper .dataTables_filter { text-align: right; }
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input[type="search"] {
        border: 1px solid #d1d5db; border-radius: .5rem; padding: .5rem .75rem;
        font-size: .875rem; line-height: 1.25rem; color: #111827; background-color: #fff;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / .05); transition: box-shadow .15s ease, border-color .15s ease;
    }
    .dataTables_wrapper .dataTables_length select { margin: 0 .5rem; padding-right: 2rem; min-width: 4.75rem; cursor: pointer; }
    .dataTables_wrapper .dataTables_filter input[type="search"] { margin-left: .5rem; min-width: 16rem; }
    .dataTables_wrapper .dataTables_length select:focus,
    .dataTables_wrapper .dataTables_filter input[type="search"]:focus {
        outline: none; border-color: var(--color-brand-600, #4f46e5);
        box-shadow: 0 0 0 1px var(--color-brand-600, #4f46e5);
    }
    .dataTables_wrapper .dataTables_info { font-size: .8125rem; color: #6b7280; padding-top: 1rem; }
    .dataTables_wrapper .dataTables_paginate { padding-top: .75rem; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: .5rem !important; font-size: .8125rem; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: var(--color-brand-600, #4f46e5) !important; border-color: var(--color-brand-600, #4f46e5) !important; color: #fff !important;
    }
    table.dataTable thead th { font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; color: #6b7280; }
    .dark .dataTables_wrapper .dataTables_length,
    .dark .dataTables_wrapper .dataTables_filter,
    .dark .dataTables_wrapper .dataTables_info { color: #9ca3af; }
    .dark .dataTables_wrapper .dataTables_length select,
    .dark .dataTables_wrapper .dataTables_filter input[type="search"] { background-color: #111827; border-color: #374151; color: #f3f4f6; }
    .dark table.dataTable thead th { color: #9ca3af; border-color: #374151; }
    .dark table.dataTable tbody td { color: #e5e7eb; border-color: #1f2937; }
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button { color: #d1d5db !important; }
</style>
