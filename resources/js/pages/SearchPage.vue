<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="10">
                <v-text-field
                    v-model="search"
                    label="Search"
                    @keydown.enter="submit"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="2">
                <v-btn size="x-large" color="indigo" block @click="submit">Search</v-btn>
            </v-col>
        </v-row>

        <div :class="loading ? 'text-center' : ''">
        <v-progress-circular v-if="loading"
                             color="blue"
                             indeterminate
                             class="mt-10"
        ></v-progress-circular>
        <v-table v-else-if="taxonomies.length > 0">
            <thead class="mt-2">
            <tr>
                <th class="text-left">
                    Name
                </th>
                <th class="text-left">
                    Count
                </th>
                <th class="text-left">
                    Image
                </th>
                <th class="text-left">
                    Fetch
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in taxonomies" :key="item.id">
                <td>{{ item.name }}</td>
                <td>{{ item.totalResults }}</td>
                <td>
                    <v-img :src="item.image"></v-img>
                </td>
                <td>
                    <v-btn
                        v-if="!fetched.includes(item.slugifiedName) && !fetchedTaxonomies.includes(item.slugifiedName)"
                        color="blue" block
                        class="mt-2"
                        @click="fetch(item.slugifiedName)">Fetch
                    </v-btn>
                    <v-btn
                        v-else
                        color="red"
                        block
                        class="mt-2">Fetched
                    </v-btn>
                </td>
            </tr>
            </tbody>
        </v-table>
        </div>
    </v-container>
</template>

<script>
import axios from "axios";
import {useQuery} from "@vue/apollo-composable";
import {fetchedTaxonomiesQuery} from "../../gql/ah";
import {computed} from "vue";

export default {
    data: vm => ({
        search: "",
        taxonomies: [],
        fetched: [],
        loading: false
    }),

    setup() {
        const {result} = useQuery(fetchedTaxonomiesQuery)

        const fetchedTaxonomies = computed(() => result.value?.taxonomies?.map(a => a.slugified_name) ?? [])

        return {
            fetchedTaxonomies
        }
    },

    methods: {
        submit() {
            if (this.search === "") {
                return;
            }

            this.loading = true

            axios.get('/api/ah/search/taxonomy', {
                params: {
                    name: this.search,
                }
            }).then((response) => {
                this.loading = false
                this.taxonomies = response.data
            })
        },
        fetch(slugifiedName) {
            axios.post('/api/ah/search/products', {
                taxonomySlug: slugifiedName,
            }).then((response) => {
                this.fetched.push(slugifiedName)
            })
        },
    }
}
</script>
