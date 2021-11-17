<template>
    <input type="text"
           v-model="message"
           @keyup.enter="sendMessage()"
    />
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
                if(res.status == 200){
                    this.message = '';
                    this.$emit('messagesent');
                }
                console.log(res)
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
