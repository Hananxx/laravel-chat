<template>
    <Head title="Log in" />

    <jet-authentication-card>
        <template #logo >
            <logo/>
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end space-x-2 mt-4">

                <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
                  Register now
                </Link>

                <jet-button class="ml-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </jet-button>

            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Components/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import JetButton from '@/Components/Button.vue'
    import JetInput from '@/Components/Input.vue'
    import JetCheckbox from '@/Components/Checkbox.vue'
    import JetLabel from '@/Components/Label.vue'
    import JetValidationErrors from '@/Components/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Logo from "../../Components/Logo";

    export default defineComponent({
        components: {
            Logo,
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
