<template>
    <div class="h-screen-3/5 overflow-scroll">
<!--        <select v-model="selected"-->
<!--                @change="$emit('roomchanged', selected)"-->
<!--                class="border-none">-->
<!--            <option v-for="(room, index) in rooms" :key="index" :value="room">-->
<!--                {{room.name}}-->
<!--            </option>-->
<!--        </select>-->

      <div @click="show = true" class="p-10 flex items-center room-item text-xl transition ease-in-out duration-75 hover:bg-gray-100 cursor-pointer">
        <div class="w-10 h-10 flex overflow-hidden text-xl rounded-full items-center justify-center bg-purple-100 text-purple-500 border-2 border-dashed border-purple-500">
          <span>+</span>
        </div>
        <h5 class="font-semibold mx-3">
          Start a new chat
        </h5>
      </div>

      <div v-for="(room, index) in rooms"
             @click="selected = room, $emit('roomchanged', selected), console.log('smh')"
             class="p-10 flex items-center room-item text-xl transition ease-in-out duration-75 hover:bg-gray-100 cursor-pointer"
             :class="selected.id === room.id ? 'shadow-inner bg-gray-50' : ''"
             :key="index">
            <div :class="room.privacy === 'public' ? 'bg-orange-100 text-orange-700' : 'bg-purple-100 text-purple-700'"
                 class="w-10 h-10 flex overflow-hidden rounded-full items-center justify-center">
                <span>{{room.name.substring(0, 2)}}</span>
            </div>
            <h3 :class="{'font-semibold': room.id === selected.id}" class="mx-3">
                {{room.name}}
            </h3>
        </div>


      <modal :show="show" v-on:close="show = false" >
        <search-users-modal v-on:invitationcreated="show = false"/>
      </modal>
      </div>

</template>

<style scoped>
    .room-item + .room-item{
        border-top: 1px solid #e9eaed;
    }
</style>

<script>
import Modal from "../../Components/Modal";
import SearchUsersModal from "./SearchUsersModal";
export default {
  components: {SearchUsersModal, Modal},
  props: [
        'currentRoom', 'rooms'
    ],
    data(){
        return {
            selected: '',
            show: false,
        }
    },
    created() {
        this.selected = this.currentRoom;
    }
}
</script>
