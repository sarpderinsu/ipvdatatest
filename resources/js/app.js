import 'bootstrap';
import {createApp, h} from "vue";
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import { createVuetify } from 'vuetify';
import App from './App.vue';
import axios from 'axios';
import router from "./router";
import {provideApolloClient} from '@vue/apollo-composable';
import {ApolloClient, createHttpLink, InMemoryCache} from "@apollo/client/core";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const httpLink = createHttpLink({uri: 'http://localhost/graphql'})

const apolloClient = new ApolloClient({
    link: httpLink,
    cache: new InMemoryCache(),
})

const app = createApp({
    setup () {
        provideApolloClient(apolloClient)
    },
    render: () => h(App),
});
const vuetify = createVuetify();

app.use(router)
app.use(vuetify)
app.mount('#app');
