<template>
  <form v-on:submit.prevent="onSubmit" @keydown="resetToDefault()">
    <div v-if="errors" class="has-error">
      <ul class="list-unstyled">
        <li v-for="error in errors"><span class="help-block">{{ error }}</span></li>
      </ul>
    </div>
    <div v-show="success" class="has-success">
      <p><span class="help-block">Coupon has been sent to {{ phone }}!</span></p>
    </div>

    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" class="form-control" placeholder="i.e. +35799123456" v-model="phone" required>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" v-model="requiredAge" required> I am over 18
      </label>
    </div>
    <div class="checkbox">
      <label>
        <input type="checkbox" v-model="tcs" required> I accept the <a href="">terms and conditions</a>
      </label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</template>

<script>
  export default {
    name: 'RegistrationForm',
    extends: {},
    props: {},
    data() {
      return {
        phone: '',
        requiredAge: false,
        tcs: false,
        errors: [],
        success: false,
      };
    },
    computed: {},
    components: {},
    watch: {},
    methods: {
      resetToDefault() {
        this.errors = [];
        this.success = false;
      },
      onSubmit() {
        axios.post('/api/sms-promotion', this.$data)
          .then((response) => {
            if (!_.isEmpty(response.data.errors)) {
              this.errors = response.data.errors;
            } else {
              this.success = true;
            }
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    beforeCreate() {},
    mounted() {}
  }
</script>
