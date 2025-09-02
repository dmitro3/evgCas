import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

export const vTippy = {
    mounted(el, binding) {
        const content = typeof binding.value === 'string' ? binding.value : (binding.value?.content ?? '');
        const placement = binding.value?.placement ?? 'right';
        const theme = binding.value?.theme ?? 'aside';

        tippy(el, {
            content,
            placement,
            theme,
            arrow: true,
            delay: [100, 0],
            offset: [0, 10],
            interactive: false,
            appendTo: () => document.body,
        });
    },
    updated(el, binding) {
        const content = typeof binding.value === 'string' ? binding.value : (binding.value?.content ?? '');
        if (el._tippy) {
            el._tippy.setContent(content);
        }
    },
    unmounted(el) {
        if (el._tippy) {
            el._tippy.destroy();
        }
    },
};
