<template title="chat">
    <chat-app-layout>
        <template v-slot:room-menu-toggle>
            <svg v-if="!showChatRoomsMenu" @click="showChatRoomsMenu = true"
                xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <svg v-if="showChatRoomsMenu" @click="showChatRoomsMenu = false"
                 xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </template>

        <template v-slot:chat-rooms-menu v-if="showChatRoomsMenu">
            <div class="absolute block md:hidden w-screen h-screen bg-white z-50">
                <h3 class="text-center border-b p-3">Available Chat Rooms</h3>
                <chat-room-selection
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomchanged="setRoom($event), showChatRoomsMenu = false"
                    v-on:roomcreated="getRooms()"
                />
                <div>
                    <h3 class="text-center border p-3">Chat Rooms Invitations</h3>
                    <chat-room-invitations
                        v-on:invitationsupdated="getRooms()"
                    />
                </div>
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
        <template v-slot:room-invitations>
            <div>
                <h3 class="text-center border-b p-3">Chat Rooms Invitations</h3>
                <chat-room-invitations
                    v-on:invitationsupdated="getRooms()"
                />
            </div>
        </template>
        <template v-slot:chat>
            <h3 class="text-center border-b pb-1 md:p-2">{{ currentRoom.name }}</h3>
            <message-container :messages="messages"/>
            <input-message
                :room="currentRoom"
                v-on:messagesent="getMessages(), resetScrollbar(),  toast.info('Your message has been sent')"
            />
        </template>
    </chat-app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import MessageContainer from "./Chat/messageContainer";
import InputMessage from "./Chat/inputMessage";
import ChatRoomSelection from "./Chat/chatRoomSelection";
import ChatAppLayout from "../Layouts/ChatAppLayout";
import ChatRoomInvitations from "./Chat/chatRoomInvitations";
import {useToast} from "vue-toastification";

export default {
    components: {
        ChatRoomInvitations,
        ChatAppLayout,
        ChatRoomSelection,
        InputMessage,
        MessageContainer,
        AppLayout
    },
    setup(){
        const toast = useToast();
        return { toast }
    },
    data() {
        return {
            chatRooms: Array,
            currentRoom: Array,
            messages: Array,
            menuShown: true,
            showChatRoomsMenu: false,
            profileToggle: false,
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
                        vm.toast.info('A message has been received');
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
