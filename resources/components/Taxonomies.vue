<template>
    <v-container>
        <v-select
            v-model="selectedModel"
            :items="taxonomies"
            item-value="id"
            item-title="name"
            model-value="id"
        ></v-select>
    </v-container>
</template>

<script>
import {useQuery} from "@vue/apollo-composable";
import {taxonomiesQuery, taxonomyQuery} from "../gql/ah";
import {computed, watch} from "vue";
import TaxonomyProducts from "./TaxonomyProducts.vue";

export default {
    components: {TaxonomyProducts},

    setup() {
        const { result } = useQuery(taxonomiesQuery)

        const taxonomies = computed(() => result.value?.taxonomies?.data ?? [])

        const selectedModel = ""
        const showTaxonomy = false

        return {
            selectedModel,
            showTaxonomy,
            taxonomies
        }
    },

    methods: {
        onSelect(event) {
            console.log(event)
        }
    }
}
</script>
