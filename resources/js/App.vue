<template>
    <v-container>
        <v-layout>
            <v-navigation-drawer>
                <v-list nav>
                    <v-list-item
                        :active="router.currentRoute.value.name === 'search'"
                        title="<< Search More"
                        @click="router.push({name: 'search'})"
                    ></v-list-item>
                    <v-divider></v-divider>
                    <v-list-item
                        :active="router.currentRoute.value.name === 'taxonomies.view' && router.currentRoute.value.params.id === taxonomy.id"
                        v-for="taxonomy in fetchedTaxonomies"
                        :title="taxonomy.name"
                        :value="taxonomy.id"
                        @click="router.push({name: 'taxonomies.view', params: {id: taxonomy.id}})"
                    ></v-list-item>
                </v-list>
            </v-navigation-drawer>
            <v-main>
                <router-view @fetched-slug="fetchMore({})"></router-view>
            </v-main>
        </v-layout>
    </v-container>
</template>

<script>
import {useQuery} from "@vue/apollo-composable";
import {fetchedTaxonomiesQuery} from "../gql/ah";
import {computed} from "vue";
import {useRouter} from "vue-router";

export default {
    setup() {
        const router = useRouter()

        const {result, fetchMore} = useQuery(fetchedTaxonomiesQuery)

        const fetchedTaxonomies = computed(() => result.value?.taxonomies ?? [])

        return {
            router,
            fetchedTaxonomies,
            fetchMore
        }
    },
}
</script>
