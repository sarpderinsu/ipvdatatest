import 'bootstrap';
import {createApp, provide, h} from "vue";
import { createVuetify } from 'vuetify';
import App from './App.vue';
import axios from 'axios';
import { DefaultApolloClient } from '@vue/apollo-composable';
import {ApolloClient, createHttpLink, InMemoryCache} from "@apollo/client/core";

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

const httpLink = createHttpLink({uri: 'http://localhost/graphql'})

const apolloClient = new ApolloClient({
    link: httpLink,
    cache: new InMemoryCache(),
})

const app = createApp({
    setup () {
        provide(DefaultApolloClient, apolloClient)
    },
    render: () => h(App),
});
const vuetify = createVuetify();

app.use(vuetify)
app.mount('#app');
