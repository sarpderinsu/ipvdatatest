<template>
    <v-container>
        <v-select
            :items="products"
            item-value="id"
            item-title="title"
        ></v-select>
    </v-container>
</template>

<script>
import {useQuery} from "@vue/apollo-composable";
import {taxonomyQuery} from "../gql/ah";
import {computed} from "vue";

export default {
    props: {
        taxonomyId: Number
    },

    setup(props) {
        const { result } = useQuery(taxonomyQuery, {id: props.taxonomyId})

        const products = computed(() => result.value?.taxonomy?.products ?? [])

        return {
            products
        }
    },
}
</script>
