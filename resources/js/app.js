// Charts first — see the note in charts.js: Alpine evaluates the DOM as soon as it starts, so
// the dashboard's chart helpers have to be on window before that happens.
import './charts.js';

// BlatUI engine: registers onto Livewire's Alpine when Livewire is on the page, or boots its
// own Alpine on pure-Blade pages.
import './blatui.js';
