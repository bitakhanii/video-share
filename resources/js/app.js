import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';
import { components } from './components';

const app = createApp({});

components(app);

app.mount('#app');


