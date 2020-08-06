<template>
    <h1>Hello</h1>
</template>
<script>
    export default {
        data(){
            return{
                editmode: false,
                todos:'',
                form: new Form({
                    name:'',
                    phone:'',
                    email:'',
                    address:''
                })
            }
        },
        methods:{

            saveData(){
                let data = new FormData();
                data.append('name', this.form.name)
                data.append('phone',this.form.phone)
                data.append('email',this.form.email)
                data.append('address',this.form.address)
                axios.post('/customer/create', data).then((res) =>{
                    this.form.reset()
                }).catch((error) => {
                    this.form.errors.record(error.response.data.errors)
                })
            }
        },

        mounted() {
        }
    }
</script>
