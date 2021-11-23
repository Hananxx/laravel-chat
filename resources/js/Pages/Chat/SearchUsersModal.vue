<template>
    <div class="flex flex-col py-3 w-full">
        <div class="rounded-full w-11/12 appearance-none border border-gray-300 px-3 py-1 flex items-center mx-auto mb-3">
            <input v-model="searchTerm" type="text" class="appearance-none border-none bg-transparent w-full" placeholder="Search users by email" @input="search()" />
            <button class="bg-purple-500 drop-shadow-purple p-2 rounded-full ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
        <hr/>
        <div class="m-auto w-full">
            <div v-for="(result, index) in searchResults" :key="index" v-if="searchTerm.length > 0"
                 class="p-4 w-full search-item flex items-center md:px-8">
                <div class="flex space-x-4 items-center">
                    <div class="w-10 h-10 bg-fuchsia-50 text-fuchsia-600 rounded-full flex items-center justify-center overflow-hidden">
                        {{result.name.substring(0, 2)}}
                    </div>
                    <div>
                        <h2 class="font-semibold">{{result.name}}</h2>
                        <h5 class="text-gray-700">{{result.email}}</h5>
                    </div>
                </div>
                <button @click="createChatRoom(result.id)"
                        class="ml-auto w-12 h-12 bg-blue-400 drop-shadow-blue rounded-full overflow-hidden flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-50" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                </button>
            </div>

            <div v-if="searchResults.length == 0 || searchTerm.length == 0" class="text-center p-2">
                No results yet
            </div>
        </div>
    </div>
</template>

<style scoped>
    .search-item + .search-item {
        border-top: 1px solid #dbdee6;
    }
</style>

<script>
import { useToast } from "vue-toastification";

    export default {
        setup(){
            const toast = useToast();
            return { toast }
        },
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
            },
            createChatRoom(id){
                axios.post('/invitation/create', { invitee_id: id })
                .then(res => {
                    this.toast.success('An invitiation has been sent');
                    this.$emit('invitationcreated')
                }).catch(err => {
                    for( var e in err.response.data.errors)
                    {
                        this.toast.error(err.response.data.errors[e][0]);
                    }
                });
            }
        }
    }
</script>
