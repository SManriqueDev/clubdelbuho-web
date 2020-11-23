<template>
    <div
        class="p-6 bg-indigo-800 min-h-screen flex justify-center items-center"
    >
        <div class="w-full max-w-md">
            <!--  <logo class="block mx-auto w-full max-w-xs fill-white" height="50" /> -->
            <form
                class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden"
                @submit.prevent="submit"
            >

                <div class="px-10 py-12">

                    <h1 class="text-center font-bold text-3xl">
                        {{ $t("register.title") }}
                    </h1>
                    <div class="mx-auto mt-6 w-24 border-b-2" />
                    <flash-messages />
                    <text-input
                        v-model="form.name"
                        :error="errors.name"
                        class="mt-10"
                        :label="$t('login.name')"
                        autofocus
                    />
                    <text-input
                        v-model="form.email"
                        :error="errors.email"
                        class="mt-6"
                        :label="$t('login.email')"
                        type="email"
                        autocapitalize="off"
                    />
                    <text-input
                        :error="errors.password"
                        v-model="form.password"
                        class="mt-6"
                        :label="$t('login.password')"
                        type="password"
                    />
                    <text-input
                        v-model="form.classroom_key"
                        class="mt-6"
                        :error="errors.classroom_key"
                        label="Código de Aula"
                    />
                </div>
                <div
                    class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center"
                >
                    <a
                        class="hover:underline"
                        tabindex="-1"
                        href="#login"
                        >Iniciar sesión</a
                    >
                    <loading-button
                        :loading="sending"
                        class="btn-indigo"
                        type="submit"
                    >
                        Registrarme
                    </loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton";
import TextInput from "@/Shared/TextInput";
import FlashMessages from "@/Shared/FlashMessages";
import AuthLayout from "@/Shared/layouts/AuthLayout";

export default {
    metaInfo: { title: "Login" },
    components: {
        LoadingButton,
        TextInput,
        FlashMessages
    },
    props: {
        errors: Object
    },
    layout: AuthLayout,
    data() {
        return {
            sending: false,
            form: {
                email: null,
                password: null,
                classroom_key: null
            }
        };
    },
    methods: {
        submit() {
            const data = {
                email: this.form.email,
                password: this.form.password,
                classroom_key: this.form.classroom_key
            };

            this.$inertia.post(this.route("register.submit"), data, {
                onStart: () => (this.sending = true),
                onFinish: () => (this.sending = false)
            });
        }
    }
};
</script>
