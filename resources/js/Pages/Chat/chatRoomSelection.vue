<template>
    <div class="h-screen">
<!--        <select v-model="selected"-->
<!--                @change="$emit('roomchanged', selected)"-->
<!--                class="border-none">-->
<!--            <option v-for="(room, index) in rooms" :key="index" :value="room">-->
<!--                {{room.name}}-->
<!--            </option>-->
<!--        </select>-->
        <div v-for="(room, index) in rooms"
             @click="selected = room, $emit('roomchanged', selected), console.log('smh')"
             class="px-5 py-7 flex items-center border-b text-xl transition ease-in-out duration-75 hover:bg-gray-100 hover:cursor-pointer"
             :class="room.id === selected.id ? 'bg-gray-50' : 'bg-white'"
             :key="index">
            <div :class="room.privacy === 'public' ? 'bg-orange-100 text-orange-700' : 'bg-purple-100 text-purple-700'"
                 class="w-10 h-10 hidden md:flex overflow-hidden rounded-full items-center justify-center">
                <span>{{room.name.substring(0, 2)}}</span>
            </div>
            <h3 :class="{'font-semibold': room.id === selected.id}" class="mx-3">
                {{room.name}}
            </h3>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'currentRoom', 'rooms'
    ],
    data(){
        return {
            selected: ''
        }
    },
    created() {
        this.selected = this.currentRoom;
    }
}
</script>
