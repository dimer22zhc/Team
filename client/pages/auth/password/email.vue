<template>
  <div>
    <div class="flex justify-center my-4">
      <form @submit.prevent="send" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="status" />

        <!-- Email -->
        <div>
          <label>{{ $t('email') }}</label>
          <div class="col-md-7">
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="email" name="email" class="appearance-none text-gray-700 text-lg py-2 border border-gray-600 focus:outline-none rounded w-full py-2 px-3">
            <has-error :form="form" field="email" />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-2">
          <div>
            <button class="shadow-sm text-xl font-bold py-2 bg-green-700  appearance-none border rounded w-full px-3 text-white">
              {{ $t('send_password_reset_link') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  head () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
