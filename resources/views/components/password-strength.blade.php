@props(['input' => 'password'])

{{--
    Real-time password strength meter (zxcvbn). Drop it right after a password
    input and point it at that input's id:  <x-password-strength input="password" />
    Advisory only — server-side policy is enforced by App\Rules\StrongPassword.
    Self-contained (inline, @once-guarded) so it works under both the guest and
    app layouts without depending on a @stack('scripts').
--}}

<div
    x-data="passwordStrength('{{ $input }}')"
    x-init="init()"
    x-show="show"
    style="display:none"
    class="mt-2"
>
    <div class="flex gap-1.5">
        <template x-for="i in 4" :key="i">
            <div class="h-1.5 flex-1 rounded-full transition-colors duration-300"
                 :class="i <= score ? barColor : 'bg-gray-200 dark:bg-gray-700'"></div>
        </template>
    </div>
    <div class="mt-1.5 flex items-center justify-between gap-2">
        <span class="text-xs font-medium" :class="labelColor" x-text="label"></span>
        <span class="text-xs text-gray-400 dark:text-gray-500" x-show="crack" x-text="crack"></span>
    </div>
    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" x-show="hint" x-text="hint"></p>
</div>

@once
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('passwordStrength', (inputId) => ({
                el: null,
                show: false,
                score: 0,
                label: '',
                hint: '',
                crack: '',
                barColor: 'bg-gray-200',
                labelColor: 'text-gray-400',
                init() {
                    this.el = document.getElementById(inputId);
                    if (! this.el) return;
                    const run = () => this.evaluate(this.el.value);
                    this.el.addEventListener('input', run);
                    run();
                },
                evaluate(val) {
                    this.show = (val || '').length > 0;
                    if (! this.show) return;
                    if (typeof window.zxcvbn !== 'function') {
                        return window.setTimeout(() => this.evaluate(this.el.value), 150);
                    }
                    const labels = ['Very weak', 'Weak', 'Fair', 'Good', 'Strong'];
                    const bars   = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-lime-500', 'bg-green-500'];
                    const lblCol = ['text-red-600', 'text-orange-600', 'text-yellow-600', 'text-lime-600', 'text-green-600'];
                    const r = window.zxcvbn(val);
                    this.score = r.score;
                    this.label = labels[r.score];
                    this.barColor = bars[r.score];
                    this.labelColor = lblCol[r.score];
                    const ct = r.crack_times_display && r.crack_times_display.offline_slow_hashing_1e4_per_second;
                    this.crack = ct ? ('Est. crack time: ' + ct) : '';
                    this.hint = (r.feedback && r.feedback.warning)
                        ? r.feedback.warning
                        : ((r.feedback && r.feedback.suggestions && r.feedback.suggestions.length) ? r.feedback.suggestions[0] : '');
                },
            }));
        });
    </script>
@endonce
