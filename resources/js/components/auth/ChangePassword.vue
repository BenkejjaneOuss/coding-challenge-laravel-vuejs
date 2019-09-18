<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change my password</div>
                    <div class="card-body">
                        <form method="post" @submit.prevent="onSubmit">
                            <b-form-group
                                id="password-group"
                                label="Password:"
                                label-for="password"
                            >
                                <b-form-input
                                id="password"
                                name="password"
                                v-model="form.password"
                                type="password"
                                placeholder="Enter new password"
                                v-validate="'required|min:8'"
                                data-vv-as="New password"
                                ref="password"
                                ></b-form-input>

                                <div class="invalid-feedback d-block" v-show="errors.has('password')">{{ errors.first('password') }}</div>
                            </b-form-group>

                            <b-form-group
                                id="password_confirmation-group"
                                label="Password confirmation:"
                                label-for="password_confirmation"
                            >
                                <b-form-input
                                id="password_confirmation"
                                name="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                placeholder="Enter password confirmation"
                                v-validate="'required|confirmed:password'"
                                data-vv-as="Password confirmation"
                                ></b-form-input>

                                <div class="invalid-feedback d-block" v-show="errors.has('password_confirmation')">{{ errors.first('password_confirmation') }}</div>
                            </b-form-group>
                            
                            <b-button type="submit" variant="primary">Change</b-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        form: {
            password:'',
            password_confirmation:'',
        },
      }
    },
    methods: {
      onSubmit() {
            //Validate form 
            this.$validator.validateAll().then(result => {
                if (!this.errors.any()) {

                    //Axios
                    axios.post(route('changePassword'), this.form).then(res => {

                        let type = 'error'
                        let title = 'Error!'
                        let text = (res.data.msg !== '') ? res.data.msg : 'Please retry later'
                        if(res.data.result) {
                            type="success"
                            title = 'Updated!'
                            text = "Your password has been updated."
                            //Reset form
                            this.form = {
                                password:'',
                                password_confirmation:'',
                            }
                            //Rest validator      
                            this.$validator.reset();
                        }

                        this.$swal.fire({
                            type: type,
                            title: title,
                            text: text,
                            showConfirmButton: false,
                            showCloseButton: true,
                        })

                    }).catch(e => {
                        console.log('createForm', e)
                    })

                }
            })
        },
    }
  }
</script>
