<template>
    <div class="flex space-x-3 p-5">
        <input type="text"
               v-model="message"
               @keyup.enter="sendMessage()"
               class="rounded appearance-none w-full border-gray-300"
               placeholder="Say something..."
        />
        <button class="rounded appearance-none bg-purple-500 drop-shadow-purple px-3 font-bold text-gray-50 flex items-center space-x-2"
                @click="sendMessage()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform -rotate-45 -mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
           <span>Send</span>
        </button>
    </div>

</template>

<script>
export default {
    props: [
        'room'
    ],
    data(){
        return {
            message: ''
        }
    },
    methods: {
        sendMessage(){
            if(this.message === ' '){
                return;
            }
            axios.post('chat/room/' + this.room.id + '/message', {
               message: this.message
            })
            .then(res => {
                if(res.status == 201){
                    this.message = '';
                    this.$emit('messagesent');
                }
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
