import './bootstrap'

import {createApp} from 'vue';
import App from './App.vue';
import router from "./routes";
import store from "./stores";
import components from './components'
import './index.css';

const app = createApp(App);
app.use(router);
app.use(store);
components(app);
app.mount("#app");
