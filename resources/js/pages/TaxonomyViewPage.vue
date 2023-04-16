<template>
    <div>
        <v-table>
            <thead class="mt-2">
            <tr>
                <th class="text-left">
                    Title
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in products" :key="item.id">
                <td>{{ item.title }}</td>
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

        const { result } = useQuery(taxonomyQuery, {id: route.params.id})

        const products = computed(() => result.value?.taxonomy?.products ?? [])

        watch(() => {
            console.log(result.value)
        })

        return {
            products
        }
    },
}
</script>
