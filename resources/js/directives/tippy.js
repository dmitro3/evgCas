import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

export const vTippy = {
    mounted(el, binding) {
        const options = normalize(binding.value);
        const instance = tippy(el, {
            content: options.content,
            placement: options.placement,
            theme: options.theme,
            arrow: true,
            delay: [100, 0],
            offset: [0, 10],
            interactive: false,
            appendTo: () => document.body,
        });
        el._tippyInstanceTheme = options.theme;
        el._tippy = instance[0];
    },
    updated(el, binding) {
        const options = normalize(binding.value);
        if (el._tippy) {
            el._tippy.setContent(options.content);
            if (options.theme && options.theme !== el._tippyInstanceTheme) {
                el._tippy.setProps({ theme: options.theme });
                el._tippyInstanceTheme = options.theme;
            }
        }
    },
    unmounted(el) {
        if (el._tippy) {
            el._tippy.destroy();
        }
    },
};

function normalize(value){
    if (typeof value === 'string') {
        return { content: value, placement: 'right', theme: 'aside' };
    }
    return {
        content: value?.content ?? '',
        placement: value?.placement ?? 'right',
        theme: value?.theme ?? 'aside',
    };
}
