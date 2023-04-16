import {createRouter, createWebHistory} from "vue-router";
import SearchPage from "./pages/SearchPage.vue";
import TaxonomyViewPage from "./pages/TaxonomyViewPage.vue";

const routes = [{
    path: '/',
    name: 'search',
    component: SearchPage
}, {
    path: '/taxonomies/:id',
    name: 'taxonomies.view',
    component: TaxonomyViewPage
}]

export default createRouter({
    history: createWebHistory(),
    routes
})
