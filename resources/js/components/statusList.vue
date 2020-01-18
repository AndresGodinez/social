<template>
    <div @click="redirectIfGuest">
        <status-list-item
            v-for="status in statuses"
            :status="status"
            :key="status.id"
        >

        </status-list-item>
    </div>
</template>

<script>
    import StatusListItem from './statusListItem'

    export default {
        data() {
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
        methods: {
            async getStatuses() {
                let response = await axios.get('/statuses');
                this.statuses = response.data.data
            },

        },
        components:{
            StatusListItem
        }

    }
</script>

<style scoped>
</style>
