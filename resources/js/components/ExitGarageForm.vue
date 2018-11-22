<template>
    <div class="card">
        <div class="card-header">All paid up and ready to leave.</div>

        <div class="card-body">
            <h3>Please follow these steps to leave the garage:</h3>
            <ol>
                <li>Drive to the exit.</li>
                <li>When you are in front of the exit gate, press the "Lift Gate" button below.</li>
                <li>Drive out, and have a great day!</li>
            </ol>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg" @click.prevent="exit">Lift Gate</button>
            </div>
        </div>
        <div class="card-footer">
            Thank you for choosing Parking Place!
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
                        alert("You have exited the garage!");
                        //tell parent userExitedGarage and pass the updated currentTicket
                        this.$emit('userExitedGarage', response.data);
                    })
                    .catch(error => {
                        //TODO: use a custom modal instead of native alert.
                        //TODO: find out if there is a better way of accessing the error string. Looks a bit gross
                        alert(error.response.data.error);
                    });
            }
        }
    
    }
</script>
