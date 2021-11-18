<template>
    <div class="flex justify-between items-center">
        <h3 class="font-bold">{{ selected.name }} Chat</h3>
        <select v-model="selected"
                @change="$emit('roomchanged', selected)"
                class="border-none">
            <option v-for="(room, index) in rooms" :key="index" :value="room">
                {{room.name}}
            </option>
        </select>
<!--        <jet-dropdown align="right" width="48">-->
<!--            <template #trigger>-->
<!--                <span class="inline-flex rounded-md">-->
<!--                     <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">-->
<!--                         {{selected.name}}-->
<!--                         <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">-->
<!--                             <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />-->
<!--                         </svg>-->
<!--                     </button>-->
<!--                </span>-->
<!--            </template>-->

<!--            <template #content>-->
<!--                &lt;!&ndash; Account Management &ndash;&gt;-->
<!--                <div class="block px-4 py-2 text-xs text-gray-400">-->
<!--                   Select chatroom-->
<!--                </div>-->

<!--                <jet-dropdown-link :href="route('profile.show')">-->
<!--                    Profile-->
<!--                </jet-dropdown-link>-->

<!--                <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">-->
<!--                    API Tokens-->
<!--                </jet-dropdown-link>-->

<!--                <div class="border-t border-gray-100"></div>-->

<!--                &lt;!&ndash; Authentication &ndash;&gt;-->
<!--                <form @submit.prevent="logout">-->
<!--                    <jet-dropdown-link as="button">-->
<!--                        Log Out-->
<!--                    </jet-dropdown-link>-->
<!--                </form>-->
<!--            </template>-->
<!--        </jet-dropdown>-->
    </div>
</template>

<script>
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'

export default {
    components: {
        JetDropdown,
        JetDropdownLink,
        JetResponsiveNavLink,
    },
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
