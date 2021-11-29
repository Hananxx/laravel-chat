<template>
    <div class="p-3 py-5 flex flex-col items-center">
        <div class="relative">
            <div class="bg-green-500 rounded-full w-3 h-3 absolute right-0 mt-3 mr-1"></div>
           <div class="bg-blue-50 w-20 h-20 rounded-full flex items-center justify-center overflow-hidden mb-3">
              <h6 class="text-blue-500 text-2xl uppercase">{{user.name.substring(0,2)}}</h6>
           </div>
        </div>

        <h3 class="text-lg font-semibold uppercase">{{user.name}}</h3>
        <h6 class="text-gray-700">{{user.email}}</h6>

       <div class="w-full border-t my-3"></div>

        <h1 class="font-semibold self-start mb-2">Chat rooms ({{rooms.length > 0 ? rooms.length : '0'}})</h1>
        <div class="sm:grid-cols-2 grid w-full gap-4 w-11/12">
            <div class="bg-gray-100 rounded-md p-1 px-2" v-for="(room, index) in rooms" :key="index" v-if="rooms.length > 0">
                <h5 class="font-semibold">{{ room.name }}</h5>
                <p class="text-sm text-gray-800">Created at: {{room.created_at.substring(0,10)}}</p>
            </div>

            <div class="p-1 px-2 text-gray-700" v-else>
               No private chat rooms yet..
            </div>
        </div>
    </div>
</template>

<script>
import { usePage } from '@inertiajs/inertia-vue3'

export default{
    data(){
        return {
            user: usePage().props.value.user,
            rooms: usePage().props.value.rooms
        }
    },
}
</script>
