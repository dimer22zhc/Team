<template>
  <div class="flex justify-center">
    <div class="shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col w-1/3">
      <div>
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div >
            <label  class="block text-grey-darker text-sm font-bold mb-2">{{ $t('name') }}</label>
            <div class="">
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker">
              <has-error :form="form" field="name" />
            </div>
          </div>

          <!-- Email -->
          <div class="">
            <label  class="block text-grey-darker text-sm font-bold mb-2">{{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker">
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="">
            <label class="block text-grey-darker text-sm font-bold mb-2">{{ $t('password') }}</label>
            <div class="">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker">
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password Confirmation -->
          <div class="form-group row">
            <label class="block text-grey-darker text-sm font-bold mb-2">{{ $t('confirm_password') }}</label>
            <div class="col-md-7">
              <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" type="password" name="password_confirmation"
                     class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker"
              >
              <has-error :form="form" field="password_confirmation" />
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-7 offset-md-3 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('register') }}
              </v-button>

              <!-- GitHub Login Button -->
              <login-with-github />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  head () {
    return { title: this.$t('register') }
  },
  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
