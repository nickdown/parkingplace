<template>
    <div class="card">
        <div class="card-header">Welcome to Parking Place!</div>

        <div class="card-body">
            <h3>Please follow the steps to park with us:</h3>
            <ol>
                <li>Drive up to the entrance gate.</li>
                <li>When your car is directly in front of the gate, click the "Enter Garage" button.</li>
                <li>Stay with us as long as you like and pay through this website when you are about to leave.</li>
            </ol>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg" @click.prevent="enter">Enter Garage</button>
            </div>
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
            enter() {
                axios.post('/api/entries')
                    .then(response => {
                        alert("You have entered the garage.");
                        //tell parent userEnteredGarage and pass the updated currentTicket
                        this.$emit('userEnteredGarage', response.data);
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
