<template>
    <div >
        <main class="md:flex md:py-1">
            <nav class="md:py-2">
                <div class="bg-white md:bg-transparent flex md:flex-col justify-around items-center md:justify-start md:h-screen-4/5 px-2 md:px-0">
                    <slot name="room-menu-toggle"/>

                    <logo class="w-10 md:w-20 h-auto md:mb-24"/>

                    <svg @click="userProfileToggle = !userProfileToggle"
                         xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer md:mb-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <form @submit.prevent="logout" class="mt-auto">
                        <button class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </nav>
            <slot name="chat-rooms-menu"/>
            <section class="mx-auto flex-grow max-h-screen md:p-3">
                <div class="grid md:grid-cols-3 2xl:grid-cols-4 gap-7">
                    <section class="hidden md:block space-y-9">
                        <div class="bg-white rounded-xl shadow-xl h-3/4">
                            <slot name="room-selection"/>
                        </div>

                        <div class="bg-white rounded-xl shadow-xl h-1/5">
                            <slot name="room-invitations"/>
                        </div>
                    </section>
                    <section class="col-span-2 2xl:col-span-3 p-2 bg-white md:rounded-xl md:shadow-xl h-full md:h-11/12 flex flex-col justify-between">
                        <slot name="chat"/>
                    </section>
                </div>
            </section>
        </main>

        <footer class="max-w-screen-xl mx-auto mt-3 text-center hidden md:block text-gray-700 ">
            <p>
                Made with <span class="text-pink-600 text-lg">♥︎</span> by
                <a class="underline" href="https://github.com/Hananxx" target="_blank">
                    @hananxx
                </a>
            </p>
        </footer>
        <modal :show="userProfileToggle" v-on:close="userProfileToggle = false">
            <user-profile/>
        </modal>
    </div>
</template>

<script>
    import Logo from "../Components/Logo";
    import Modal from "../Components/Modal";
    import UserProfile from "../Pages/Profile/UserProfile";
    export default {
        components: {UserProfile, Modal, Logo},
        data(){
            return {
                userProfileToggle: false,
            }
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
