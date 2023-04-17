<template>
    <v-container :class="loading ? 'text-center' : ''">
        <v-progress-circular v-if="loading"
                             color="blue"
                             indeterminate
                             class="mt-10"
        ></v-progress-circular>
        <v-table v-else>
            <thead>
            <tr>
                <th class="text-left">
                    Title
                </th>
                <th class="text-left">
                    Image
                </th>
                <th class="text-left">
                    Link
                </th>
                <th class="text-left">
                    Brand
                </th>
                <th class="text-left">
                    Category
                </th>
                <th class="text-left">
                    Size
                </th>
                <th class="text-left">
                    Price
                </th>
                <th class="text-left">
                    Discount
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in products" :key="item.id">
                <td>{{ item.title }}</td>
                <td>
                    <v-img v-if="item.image" :src="item.image"></v-img>
                    <div v-else>n/a</div>
                </td>
                <td>
                    <v-btn color="blue" :href="'https://ah.nl/' + item.link">ah.nl</v-btn>
                </td>
                <td>{{ item.brand }}</td>
                <td>{{ item.category }}</td>
                <td>{{ item.price.unitSize }}</td>
                <td>
                    <v-chip
                        v-if="item.price.was"
                        class="ma-2">
                        <s>{{ Number(item.price.was).toFixed(2) }}</s>
                    </v-chip>
                    <v-chip
                        :color="item.price.theme === 'bonus' ? 'orange' : 'blue'"
                        class="ma-2">
                        {{ Number(item.price.now).toFixed(2) }}
                    </v-chip>
                    <v-chip
                        v-if="item.price.unitInfo"
                        class="ma-2"
                        color="green"
                        text-color="white">
                        {{ Number(item.price.unitInfo.price).toFixed(2) }} / {{ item.price.unitInfo.description }}
                    </v-chip>
                </td>
                <td>
                    <v-chip v-if="item.discount.bonusType" color="orange">{{ item.discount.bonusType }}</v-chip>
                    <v-chip v-if="item.discount.promotionType" color="blue">{{ item.discount.promotionType }}</v-chip>
                </td>
            </tr>
            </tbody>
        </v-table>
    </v-container>
</template>

<script>
import {useQuery} from "@vue/apollo-composable";
import {taxonomyQuery} from "../../gql/ah";
import {computed} from "vue";
import {useRoute} from "vue-router";

export default {
    setup() {
        const route = useRoute()

        const variables = computed(() => ({id: route.params.id}));
        const {result, loading} = useQuery(taxonomyQuery, variables)

        const products = computed(() => result.value?.taxonomy?.products ?? [])

        return {
            loading,
            products
        }
    },
}
</script>
