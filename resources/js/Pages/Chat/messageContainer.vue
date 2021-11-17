<template>
    <div v-for="message in messages" :key="message.id">

        <message-item :message="message"/>
    </div>
</template>

<script>
import MessageItem from "./messageItem";
export default {
    components: {MessageItem},
    props: ['messages']
}
</script>
