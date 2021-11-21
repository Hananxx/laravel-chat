<template>
    <div class="flex flex-col py-3 w-full">
        <div class="rounded-full w-11/12 appearance-none border border-gray-300 px-3 py-1 flex items-center mx-auto mb-3">
            <input v-model="searchTerm" type="text" class="appearance-none border-none bg-transparent w-full" placeholder="Search users by email" @input="search()" />
            <button class="bg-purple-500 drop-shadow-purple p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
        <hr/>
        <div class="m-auto w-full">
            <div v-for="(result, index) in searchResults" :key="index" v-if="searchTerm.length > 0"
                 class="p-4 w-full search-item flex space-x-3 items-center px-8">
                <div class="w-10 h-10 bg-orange-100 text-orange-700 rounded-full flex items-center justify-center overflow-hidden">
                    {{result.name.substring(0, 2)}}
                </div>
                <div>
                    <h2 class="font-semibold">{{result.name}}</h2>
                    <h5 class="text-gray-700">{{result.email}}</h5>
                </div>

            </div>

            <div v-if="searchResults.length == 0 || searchTerm.length == 0" class="text-center p-2">
                No results yet
            </div>
        </div>
    </div>
</template>

<style scoped>
    .search-item + .search-item{
        border-top: 1px solid #dbdee6;
    }
</style>

<script>
    export default {
        data(){
            return {
                searchTerm: '',
                searchResults: []
            }
        },
        methods: {
            search(){
                axios.get('/user', { params: { searchTerm: this.searchTerm } })
                    .then(res => {
                        this.searchResults = res.data;
                        console.log(res.data)
                    }).catch(err => {
                        console.log(err)
                    });
            }
        }
    }
</script>
