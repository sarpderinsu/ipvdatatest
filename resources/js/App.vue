<template>
    <v-container>
        <v-text-field
            v-model="search"
            label="Search"
            @keydown.enter="submit"
        ></v-text-field>
        <v-btn block class="mt-2" @click="submit">Submit</v-btn>

        <v-table>
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
                <td>{{ item.totalProductCount }}</td>
                <td><v-img :src="item.image"></v-img></td>
                <td>
                    <v-btn v-if="!fetched.includes(item.slugifiedName)" color="blue" block class="mt-2" @click="fetch(item.slugifiedName)">Fetch</v-btn>
                    <v-btn v-else color="red" block class="mt-2">Fetched</v-btn>
                </td>
            </tr>
            </tbody>
        </v-table>
    </v-container>
</template>

<script>
import Taxonomies from "../components/Taxonomies.vue";
import axios from "axios";

export default {
    components: {Taxonomies},

    data: vm => ({
        search: "",
        taxonomies: [],
        fetched: []
    }),

    methods: {
        submit() {
            if (this.search === "") {
                return;
            }

            axios.get('/api/ah/search/taxonomy', {
                params: {
                    name: this.search,
                }
            }).then((response) => {
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
