<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add item</div>
                    <div class="card-body">
                        <form method="post" @submit.prevent="onSubmit" enctype="multipart/form-data">
                            <b-form-group
                                id="title-group"
                                label="Title:"
                                label-for="title"
                            >
                                <b-form-input
                                    id="title"
                                    name="title"
                                    v-model="form.title"
                                    type="text"
                                    placeholder="Enter title"
                                    v-validate="'required'"
                                    data-vv-as="Title"
                                ></b-form-input>

                                <div class="invalid-feedback d-block" v-show="errors.has('title')">{{ errors.first('title') }}</div>
                            </b-form-group>

                            <b-form-group
                                id="description-group"
                                label="Description:"
                                label-for="description"
                            >
                                <b-form-textarea
                                    id="description"
                                    name="description"
                                    v-model="form.description"
                                    placeholder="Enter description..."
                                    rows="3"
                                    v-validate="'required|min:20'"
                                    data-vv-as="Description"
                                ></b-form-textarea>

                                <div class="invalid-feedback d-block" v-show="errors.has('description')">{{ errors.first('description') }}</div>
                            </b-form-group>

                            <b-form-group
                                id="imageFile-group"
                                label="Image:"
                                label-for="imageFile"
                            >
                                <b-form-file
                                    id="imageFile"
                                    name="imageFile"
                                    v-model="form.imageFile"
                                    placeholder="Choose a image or drop it here..."
                                    drop-placeholder="Drop image here..."
                                    v-validate="'required|size:1024|image'"
                                    data-vv-as="Image"
                                    @change="onFileChanged"
                                ></b-form-file>

                                <div class="invalid-feedback d-block" v-show="errors.has('imageFile')">{{ errors.first('imageFile') }}</div>
                            </b-form-group>

                            <b-button type="submit" variant="primary">Add</b-button>
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
            title:'',
            description:'',
            image:'',
            imageFile:'',
        },
      }
    },
    methods: {
        onFileChanged (e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.form.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        onSubmit() {
            //Form validation
            this.$validator.validateAll().then(result => {
                if (!this.errors.any()) {
                    //axios
                    axios.post(route('addItem'), this.form).then(res => {
    
                        let type = 'error'
                        let title = 'Error!'
                        let text = (res.data.msg !== '') ? res.data.msg : 'Please retry later'

                        if(res.data.result) {
                            type="success"
                            title = 'Added!'
                            text = "Your item has been added."
                            //Reset form
                            this.form = {
                                title:'',
                                description:'',
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
