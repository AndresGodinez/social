<template>
    <form @submit.prevent="createStatus" v-if="isAuthenticated">
        <div class="card-body">
                            <textarea v-model="body"
                                      class="form-control border-0 bg-light"
                                      name="body" id=""
                                      :placeholder="`¿Qué estas pensando ${currentUser.name}?`"></textarea>
        </div>
        <div class="card-footer">
            <button id="create-status" class="btn btn-primary">Publicar estado</button>
        </div>
    </form>
    <div class="card-body" v-else>
        <a href="/login"> Debes de hacer login</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body: ''
            }
        },
        name: "statusForm",

        methods: {
            async createStatus() {
                let response = await axios.post('statuses', {
                    body: this.body
                });
                EventBus.$emit('status-created', response.data.data);
                this.body = '';
            }
        }
    }
</script>

<style scoped>

</style>