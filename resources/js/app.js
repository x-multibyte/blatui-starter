// The demo renders charts, so it registers the opt-in chart engine alongside
// the core. A components-only app would simply `import './blatui.js'` (no
// charts → no ApexCharts).
import Alpine from 'alpinejs';
import {registerBlatUI} from './blatui-core.js';
import {registerCharts} from './blatui-charts.js';

function register(alpine) {
    if (!alpine || alpine._blatui_registered) return;
    alpine._blatui_registered = true;
    // The demo is a dark-aware showcase, so it opts into following the OS preference.
    // (The package default is light-until-toggled — see blatui.js / registerBlatUI.)
    registerBlatUI(alpine, {darkMode: 'system'});
    registerCharts(alpine);
}

document.addEventListener('alpine:init', () => {
    register(window.Alpine);
});

if (window.Alpine) {
    register(window.Alpine);
} else {
    window.Alpine = Alpine;
    register(Alpine);
    Alpine.start();
}
