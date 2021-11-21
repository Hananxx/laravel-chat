<template>
                    <chat-app-layout>
                        <template v-slot:chat-rooms-menu>
                            <div class="absolute w-screen h-screen bg-white z-50">
                                <h3 class="text-center border-b p-3">Available Chat Rooms</h3>
                                <chat-room-selection
                                    v-if="currentRoom.id"
                                    :rooms="chatRooms"
                                    :currentRoom="currentRoom"
                                    v-on:roomchanged="setRoom($event)"
                                />
                            </div>

                        </template>
                        <template v-slot:room-selection>
                                <h3 class="text-center border-b p-3">Available Chat Rooms</h3>
                                <chat-room-selection
                                    v-if="currentRoom.id"
                                    :rooms="chatRooms"
                                    :currentRoom="currentRoom"
                                    v-on:roomchanged="setRoom($event)"
                                />
                        </template>
                        <template v-slot:chat>
                            <message-container :messages="messages"/>
                            <input-message
                                :room="currentRoom"
                                v-on:messagesent="getMessages(), resetScrollbar()"
                            />
                        </template>
                    </chat-app-layout>



<!--                    <div class="grid grid-cols-3 gap-7 ">-->
<!--                        <section class="bg-white rounded-xl shadow-xl h-2/3 ">-->
<!--                            <h3 class="text-center border-b p-3">Available Chat Rooms</h3>-->
<!--                            <chat-room-selection-->
<!--                                v-if="currentRoom.id"-->
<!--                                :rooms="chatRooms"-->
<!--                                :currentRoom="currentRoom"-->
<!--                                v-on:roomchanged="setRoom($event)"-->
<!--                            />-->
<!--                        </section>-->
<!--                        <section class="col-span-2 p-2 bg-white rounded-xl shadow-xl h-4/5 flex flex-col justify-between">-->
<!--                            <message-container :messages="messages"/>-->
<!--                            <input-message-->
<!--                                :room="currentRoom"-->
<!--                                v-on:messagesent="getMessages()"-->
<!--                            />-->
<!--                        </section>-->

<!--                    </div>-->
</template>
<style>
    /*body{*/
    /*    overflow: hidden;*/
    /*}*/
</style>
<script>
import AppLayout from "../Layouts/AppLayout";
import MessageContainer from "./Chat/messageContainer";
import InputMessage from "./Chat/inputMessage";
import ChatRoomSelection from "./Chat/chatRoomSelection";
import ChatAppLayout from "../Layouts/ChatAppLayout";

export default {
    components: {
        ChatAppLayout,
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
        },
        resetScrollbar(){
            let c = document.getElementById('chat-container');
            c.scrollTop = 0;
        }
    }
}
</script>
