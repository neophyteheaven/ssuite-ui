{{--
    Shared DataTables admin-grid styling for the suite. Brand-tinted header,
    row hover, and brand-styled "Show entries" length dropdown + "Search" input
    (plus info + pagination) so a DataTable matches the app chrome. Themed with
    each app's --color-brand-* CSS variables so it retheme's automatically.

    This mirrors the rules each app already ships in resources/css/app.css
    (table chrome) + the layout control CSS. Reference rendering lives in the
    ssuite-ui style guide "Data table" section. Include once per page if an app
    does not already compile these into app.css.
--}}
<style>
    /* length + search controls */
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
    /* table chrome */
    table.dataTable { width: 100% !important; border-collapse: collapse; font-size: .875rem; color: #6b7280; }
    table.dataTable thead { text-transform: uppercase; font-size: .75rem; letter-spacing: .05em;
        color: var(--color-brand-700, #4338ca); background-color: var(--color-brand-50, #eef2ff); }
    table.dataTable thead th { padding: .75rem 1.5rem; font-weight: 500; text-align: left; border-bottom: 1px solid #e5e7eb; }
    table.dataTable tbody tr { background: #fff; border-bottom: 1px solid #e5e7eb; transition: background-color .12s ease; }
    table.dataTable tbody tr:hover { background-color: var(--color-brand-50, #eef2ff); }
    table.dataTable tbody td { padding: 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; color: #374151; vertical-align: middle; }
    /* sort arrows */
    table.dataTable thead th.sorting, table.dataTable thead th.sorting_asc, table.dataTable thead th.sorting_desc { cursor: pointer; position: relative; }
    table.dataTable thead th.sorting::before, table.dataTable thead th.sorting::after,
    table.dataTable thead th.sorting_asc::before, table.dataTable thead th.sorting_asc::after,
    table.dataTable thead th.sorting_desc::before, table.dataTable thead th.sorting_desc::after { display: none; }
    table.dataTable thead th.sorting::after,
    table.dataTable thead th.sorting_asc::after,
    table.dataTable thead th.sorting_desc::after {
        display: block; position: absolute; right: .9rem; top: 50%; transform: translateY(-50%); font-size: .85em; line-height: 1;
    }
    table.dataTable thead th.sorting::after { content: "\2195"; opacity: .35; }
    table.dataTable thead th.sorting_asc::after { content: "\2191"; }
    table.dataTable thead th.sorting_desc::after { content: "\2193"; }
    /* info + pagination */
    .dataTables_wrapper .dataTables_info { font-size: .8125rem; color: #6b7280; padding-top: 1rem; }
    .dataTables_wrapper .dataTables_paginate { padding-top: .75rem; }
    .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: .5rem !important; font-size: .8125rem; }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: var(--color-brand-600, #4f46e5) !important; border-color: var(--color-brand-600, #4f46e5) !important; color: #fff !important;
    }
    /* dark mode */
    .dark .dataTables_wrapper .dataTables_length,
    .dark .dataTables_wrapper .dataTables_filter,
    .dark .dataTables_wrapper .dataTables_info { color: #9ca3af; }
    .dark .dataTables_wrapper .dataTables_length select,
    .dark .dataTables_wrapper .dataTables_filter input[type="search"] { background-color: #111827; border-color: #374151; color: #f3f4f6; }
    .dark table.dataTable { color: #9ca3af; }
    .dark table.dataTable thead { color: var(--color-brand-300, #a5b4fc); background-color: var(--color-brand-900, #312e81); }
    .dark table.dataTable thead th { border-color: #374151; }
    .dark table.dataTable tbody tr { background: #1f2937; border-color: #374151; }
    .dark table.dataTable tbody tr:hover { background-color: rgba(49,46,129,.30); }
    .dark table.dataTable tbody td { color: #e5e7eb; border-color: #374151; }
    .dark .dataTables_wrapper .dataTables_paginate .paginate_button { color: #d1d5db !important; }
</style>
