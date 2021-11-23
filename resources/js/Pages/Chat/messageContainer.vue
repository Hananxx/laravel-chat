<template>
        <chat-messages-layout>
            <div class="flex flex-col" v-for="message in messages" :key="message.id">
                <message-item
                    :class="checkSender(message.user.id) ? 'self-end' : 'self-start'"
                    :message="message"
                    :sender="checkSender(message.user.id)"
                />
            </div>
        </chat-messages-layout>
</template>

<script>
import MessageItem from "./messageItem";
import { usePage } from '@inertiajs/inertia-vue3'
import ChatMessagesLayout from "../../Layouts/ChatMessagesLayout";

export default {
    components: {ChatMessagesLayout, MessageItem},
    props: ['messages'],
    methods: {
        checkSender(id){
            return usePage().props.value.user.id === id;
        }
    }
}
</script>
