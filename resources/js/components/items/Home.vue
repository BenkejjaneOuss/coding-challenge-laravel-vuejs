<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    <div v-for="(item, $index) in list" :key="$index">
                <b-card no-body class="overflow-hidden mb-3" style="max-width: 540px;" >
                    <b-row no-gutters>
                    <b-col md="6">
                        <b-card-img :src="show_image(item.image)" class="rounded-0"></b-card-img>
                    </b-col>
                    <b-col md="6">
                        <b-card-body :title="item.title">
                        <b-card-text>
                            {{item.description}}
                        </b-card-text>
                        </b-card-body>
                    </b-col>
                    </b-row>
                </b-card>
                </div>
                <infinite-loading @infinite="infiniteHandler"></infinite-loading>


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                page: 1,
                list: [],
            }
        },
        methods: {
            //Infinite scrool
            infiniteHandler($state) {
                //axios
                axios.get(route('getItems', {page: this.page}))
                .then(res => {
                    if (res.data.items.length) {
                        //Adding 10 items
                        this.page += 10;
                        this.list.push(...res.data.items);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                }).catch(e => {
                    console.log('createForm', e)
                    this.loading = false
                })
            },
            //Showing image
            show_image(image){
				let imageName = image
				let path = "storage/images/"
				return path + imageName
			},

        }
    }
    </script>
