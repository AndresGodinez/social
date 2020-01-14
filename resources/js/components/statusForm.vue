<template>
    <form @submit.prevent="createStatus">
        <div class="card-body">
                            <textarea v-model="body"
                                    class="form-control border-0 bg-light"
                                    name="body" id=""
                                    placeholder="¿Qué estas pensando Andrés?"></textarea>
        </div>
        <div class="card-footer">
            <button id="create-status" class="btn btn-primary">Publicar estado</button>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
            return {
                body:''
            }
        },
        name: "statusForm",
        methods:{
            async createStatus(){
                let response = await axios.post('statuses', {
                    body: this.body
                });
                console.log({'response' : response.data});
            }
        }
    }
</script>

<style scoped>

</style>