<template>
    <div>
        <h3 class="font-bold">{{ selected.name }} Chat</h3>
        <select v-model="selected"
                @change="$emit('roomchanged', selected)"
        >
            <option v-for="(room, index) in rooms" :key="index" :value="room">
                {{room.name}}
            </option>
        </select>
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
