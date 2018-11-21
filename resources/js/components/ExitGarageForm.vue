<template>
    <div class="card">
        <div class="card-header">You have successfully paid!</div>

        <div class="card-body">
            <h3>Please follow these steps to leave the garage:</h3>
            <ol>
                <li>Drive to the exit.</li>
                <li>When you are in front of the exit gate, press the "Lift Gate" button below.</li>
                <li>Drive out, and have a great day!</li>
            </ol>
            <form>
                <button type="submit" class="btn btn-primary" @click.prevent="exit">Lift Gate</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                //
            }
        },

        created() {
            
        },

        methods: {
            exit() {
                axios.post('/api/exits')
                    .then(response => {
                        alert(response.data);
                        this.$emit('userExitedGarage');
                    });
            }
        }
    
    }
</script>
