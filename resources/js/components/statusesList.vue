<template>
    <div>
        <div class="card border-0 mb-3 shadow-sm" v-for="status in statuses">
            <div class="card-body d-flex flex-column">
                <div class=" d-flex align-items-center mb-3">
                    <img class="rounded mr-3 shadow-sm" width="40px"
                         src="https://f0.pngfuel.com/png/592/884/black-and-white-cartoon-character-programmer-computer-programming-computer-software-computer-icons-programming-language-avatar-png-clip-art.png"
                         alt="">
                    <div class="">
                        <h5 class="mb-1" v-text="status.user_name"></h5>
                        <div class="small text-muted" v-text="status.ago"></div>
                    </div>
                </div>

                <p class="card-text text-secondary" v-text="status.body"></p>
            </div>
            <div class="card-footer">

                <button v-if="status.is_liked"
                        @click="unlike(status)"
                        class="btn btn-link"
                        dusk="unlike-btn"
                ><strong>
                    <i class="fas fa-thumbs-up"></i>
                    TE GUSTA</strong></button>

                <button v-else
                        @click="like(status)"
                        class="btn btn-link"
                        dusk="like-btn"
                >
                    <i class="far fa-thumbs-up"></i>
                    ME GUSTA</button>
            </div>
        </div>
    </div>
</template>

<script>
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
            like(status) {
                axios.post(`/statuses/${status.id}/likes`)
                    .then(res => {
                        status.is_liked = true
                    })
                .catch(err=>{
                    console.error(err.response.data);
                });
            },
            unlike(status){
                axios.delete(`/statuses/${status.id}/likes`)
                    .then(res => {
                        status.is_liked = false
                    })
                    .catch(err=>{
                        console.error(err.response.data);
                    });
            }

        },

    }
</script>

<style scoped>

</style>