<template>
    <div>
        <div v-for="status in statuses" v-text="status.body"></div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                statuses: [],
            }
        },
        mounted() {
            EventBus.$on('status-created', status => {
                this.statuses.unshift(status)
            });
            this.getStatuses();
        },
        methods:{
            async getStatuses(){
                let response = await axios.get('/statuses');
                this.statuses = response.data.data
            }
        }
    }
</script>

<style scoped>

</style>