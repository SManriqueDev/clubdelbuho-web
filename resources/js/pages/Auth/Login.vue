<template>
  <div class="p-6 bg-indigo-800 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-md">
      <!--  <logo class="block mx-auto w-full max-w-xs fill-white" height="50" /> -->
      <form
        class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden"
        @submit.prevent="submit"
      >
        <div class="px-10 py-12">
          <h1 class="text-center font-bold text-3xl">
            ¡{{ $t("login.welcome") }}!
          </h1>
          <div class="mx-auto mt-6 w-24 border-b-2" />
          <text-input
            v-model="form.email"
            :error="errors.email"
            class="mt-10"
            :label="$t('login.email')"
            type="email"
            autofocus
            autocapitalize="off"
          />
          <text-input
            v-model="form.password"
            class="mt-6"
            :label="$t('login.password')"
            type="password"
          />
          <label class="mt-6 select-none flex items-center" for="remember">
            <input
              id="remember"
              v-model="form.remember"
              class="mr-1"
              type="checkbox"
            />
            <span class="text-sm">{{ $t("login.remember-me") }}</span>
          </label>
        </div>
        <div
          class="px-10 py-4 bg-gray-100 border-t border-gray-200 flex justify-between items-center"
        >
          <a class="hover:underline" tabindex="-1" href="#reset-password"
            >{{ $t("login.forget-password") }}?</a
          >
          <loading-button :loading="sending" class="btn-indigo" type="submit">{{
            $t("actions.access")
          }}</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LoadingButton from "@/shared/LoadingButton";
import Logo from "@/shared/Logo";
import TextInput from "@/shared/TextInput";
import AuthLayout from "@/shared/layouts/AuthLayout";
export default {
  metaInfo: { title: "Login" },
  components: {
    LoadingButton,
    Logo,
    TextInput,
  },
  props: {
    errors: Object,
  },
  layout: AuthLayout,
  data() {
    return {
      sending: false,
      form: {
        email: "johndoe@example.com",
        password: "secret",
        remember: null,
      },
    };
  },
  methods: {
    submit() {
      const data = {
        email: this.form.email,
        password: this.form.password,
        remember: this.form.remember,
      };

      this.$inertia.post(this.route("login.attempt"), data, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
      });
    },
  },
};
</script>
