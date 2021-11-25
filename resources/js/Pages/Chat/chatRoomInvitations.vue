<template>
    <div class="h-screen-1/5 overflow-scroll">
        <div v-for="(invite, index) in invitations" :key="index"
             class="invitation-item p-9 flex items-center justify-between text-xl transition ease-in-out duration-75 hover:bg-gray-100">
            <div class="mx-3">
                <h4 class="font-semibold">
                    {{ invite.inviter.name }}
                </h4>
                <h6 class="text-sm text-gray-600">
                     has invited you to chat with them!
                </h6>
            </div>

            <div class="flex items-center space-x-4">

                <button @click="acceptInvitation(invite.id)"
                        :disabled="disableBtn"
                        class="w-8 h-8 flex overflow-hidden text-xl rounded-full items-center justify-center bg-blue-400 drop-shadow-blue text-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>

                <button @click="rejectInvitation(invite.id)"
                        :disabled="disableBtn"
                        class="w-8 h-8 flex overflow-hidden text-xl rounded-full items-center justify-center bg-gray-200 drop-shadow text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div v-if="invitations.length < 1" class="p-9 text-gray-600 text-center">
                   No pending invitations...
        </div>
<!--        <modal :show="show" v-on:close="show = false" >-->
<!--            <search-users-modal v-on:newroomcreated="$emit('roomcreated'), show = false"/>-->
<!--        </modal>-->
    </div>

</template>

<style scoped>
    .invitation-item + .invitation-item{
        border-top: 1px solid #e9eaed;
    }
</style>

<script>
    import {useToast} from "vue-toastification";

    export default {
        setup(){
            const toast = useToast();
            //this.connect();
            return { toast }
        },
        data(){
            return {
                invitations: [],
                disableBtn: false,
            }
        },
        methods: {
            connect(){
                let vm = this;
                this.getInvitations();
                window.Echo.channel('invitations')
                    .listen('.App\\Events\\NewInvitation', (e) => {
                        vm.getInvitations();
                    })
            },
            getInvitations(){
                axios.get('/invitation')
                .then(res => {
                    this.invitations = res.data;
                    this.disableBtn = false;
                }).catch(err => {
                    console.log(err)
                })
            },
            acceptInvitation(id){
                this.disableBtn = true;
                axios.post('/invitation/accept', { inviteId: id })
                .then(res => {
                    this.getInvitations();
                    this.$emit('invitationsupdated');
                    this.toast.success('Invitation accepted');
                }).catch(err => {
                    this.disableBtn = false;
                })
            },
            rejectInvitation(id){
                this.disableBtn = true;
                axios.post('/invitation/reject', { id: id })
                    .then(res => {
                        this.getInvitations();
                        this.$emit('invitationsupdated');
                        this.toast.warning('Invitation was rejected');
                    }).catch(err => {
                    this.disableBtn = false;
                })
            },
        },
        mounted() {
            this.getInvitations();
            this.connect();
        }
    }
</script>
