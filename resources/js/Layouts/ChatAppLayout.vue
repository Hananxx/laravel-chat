<template>
    <main>
        <nav class="p-2 lg:mb-4">
            <div class="mx-auto max-w-screen-2xl flex justify-between items-center px-2 md:px-0">
                <svg v-if="!showChatRoomsMenu" @click="showChatRoomsMenu = true"
                    xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden cursor-pointer" viewBox="0 0 20 20" fill="currentColor" >
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                </svg>

                <svg v-if="showChatRoomsMenu" @click="showChatRoomsMenu = false"
                    xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:hidden cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>

                <logo/>

                <form @submit.prevent="logout">
                    <button class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </nav>

        <slot v-if="showChatRoomsMenu" name="chat-rooms-menu"/>

        <section class="mx-auto max-w-screen-2xl max-h-screen">
            <div class="grid md:grid-cols-3 gap-7">
                <section class="hidden md:block space-y-9">
                    <div class="bg-white rounded-xl shadow-xl h-3/4">
                        <slot name="room-selection"/>
                    </div>

                    <div class="bg-white rounded-xl shadow-xl h-1/5">
                        <slot name="room-invitations"/>
                    </div>
                </section>
                <section class="col-span-2 p-2 bg-white md:rounded-xl md:shadow-xl h-full md:h-11/12 flex flex-col justify-between">
                   <slot name="chat"/>
                </section>
            </div>
        </section>
        <footer class="max-w-screen-xl mx-auto mt-12 text-center hidden md:block text-gray-500">
            <p>
                Made by @hananxx
                <span class="text-red-400">♥︎</span>
            </p>
        </footer>
    </main>
</template>

<script>
    import Logo from "../Components/Logo";
    export default {
        components: {Logo},
        data(){
        return {
            showChatRoomsMenu: false,
        }
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    }
    }
</script>
