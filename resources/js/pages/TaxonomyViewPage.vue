<template>
    <div>
        <v-table>
            <thead>
            <tr>
                <th class="text-left">
                    Title
                </th>
                <th class="text-left">
                    Image
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in products" :key="item.id">
                <td>{{ item.title }}</td>
                <td><v-img :src="item.image"></v-img></td>
            </tr>
            </tbody>
        </v-table>
    </div>
</template>

<script>
import {useQuery} from "@vue/apollo-composable";
import {taxonomyQuery} from "../../gql/ah";
import {computed, watch} from "vue";
import {useRoute} from "vue-router";

export default {
    setup() {
        const route = useRoute()

        const variables = computed(() => ({id: route.params.id}));
        const { result } = useQuery(taxonomyQuery, variables)

        const products = computed(() => result.value?.taxonomy?.products ?? [])

        return {
            products
        }
    },
}
</script>
