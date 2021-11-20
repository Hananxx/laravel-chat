<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-screen mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-3">
                    <section class="bg-white border-r">
                        <chat-room-selection
                            v-if="currentRoom.id"
                            :rooms="chatRooms"
                            :currentRoom="currentRoom"
                            v-on:roomchanged="setRoom($event)"
                        />
                    </section>
                    <section class="col-span-2">
                        <message-container :messages="messages"/>
                        <input-message
                            :room="currentRoom"
                            v-on:messagesent="getMessages()"
                        />
                    </section>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import MessageContainer from "./Chat/messageContainer";
import InputMessage from "./Chat/inputMessage";
import ChatRoomSelection from "./Chat/chatRoomSelection";

export default {
    components: {
        ChatRoomSelection,
        InputMessage,
        MessageContainer,
        AppLayout
    },
    data() {
        return {
            chatRooms: Array,
            currentRoom: Array,
            messages: Array
        }
    },
    created() {
        this.getRooms();
    },
    watch: {
        currentRoom(val, oldVal) {
            if(oldVal.id){
                this.disconnect(oldVal);
            }
            this.connect();
        }
    },
    methods: {
        connect(){
            if(this.currentRoom.id){
                let vm = this;
                this.getMessages();
                window.Echo.private('chat.'+this.currentRoom.id)
                    .listen('.App\\Events\\NewChatMessage', (e) => {
                        vm.getMessages();
                    })
            }
        },
        disconnect(room){
            window.Echo.leave('chat.'+room.id);
        },
        getRooms(){
            axios.get('chat/rooms')
                .then(res => {
                    this.chatRooms = res.data;
                    this.setRoom(this.chatRooms[0]);
                    this.getMessages();
                }).catch(err => {
                console.log(err)
            })
        },
        setRoom(room){
            this.currentRoom = room;
        },
        getMessages(){
            axios.get('chat/room/'+this.currentRoom.id+'/messages')
                .then(res => {
                    this.messages = res.data;
                }).catch(err => {
                console.log(err);
            })
        }
    }
}
</script>
