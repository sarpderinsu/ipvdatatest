<template>
    <v-container>
        <v-sheet width="300" class="mx-auto">
            <v-form validate-on="submit" @submit.prevent="submit">
                <v-text-field
                    v-model="userName"
                    :rules="rules"
                    label="User name"
                ></v-text-field>
                <v-btn type="submit" block class="mt-2">Submit</v-btn>
            </v-form>
        </v-sheet>
<!--        <v-list-item-->
<!--            v-for="product in products"-->
<!--            :key="product.id"-->
<!--            :title="product.taxonomy_slug"-->
<!--        ></v-list-item>-->
    </v-container>
</template>

<script>
import axios from 'axios';
import { useQuery } from '@vue/apollo-composable'
import {computed, watch} from "vue";
import {albertHeijnProducts, albertHeijnTaxonomySlugs} from '../gql/albert_heijn'

export default {
    setup() {
        const { result } = useQuery(albertHeijnProducts)

        const { result: slugResults } = useQuery(albertHeijnTaxonomySlugs)
        // const products = computed(() => result.value?.albertHeijnProducts?.data ?? [])
        const slugs = computed(() => slugResults.value?.albertHeijnTaxonomySlugs?.data ?? [])
        watch(result, value => {
            console.log(value)
        })

        watch(slugResults, value => {
            console.log(value)
        })

        return {
            // products,
            slugs
        }
    },
    //
    // data: vm => ({
    //     userName: '',
    //     rules: [
    //         value => vm.checkApi(value),
    //     ],
    //     timeout: null,
    // }),
    // methods: {
    //     async submit (event) {
    //         const results = await axios.get('/api/ah/search/taxonomy', {
    //             params: {
    //                 name: 'bier',
    //             }
    //         }).then((res) => {
    //             console.log(res)
    //         });
    //
    //
    //     },
    //     async checkApi (userName) {
    //         return new Promise(resolve => {
    //             clearTimeout(this.timeout)
    //             this.timeout = setTimeout(() => {
    //                 if (!userName) return resolve('Please enter a user name.')
    //                 if (userName === 'johnleider') return resolve('User name already taken. Please try another one.')
    //
    //                 return resolve(true)
    //             }, 1000)
    //         })
    //     },
    // },
}
</script>
