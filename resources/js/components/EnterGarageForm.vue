<template>
    <div class="card">
        <div class="card-header">Welcome to Parking Place!</div>

        <div class="card-body">
            <h2>Welcome to Parking Place!</h2>
            <h3>Please follow the steps to park with us:</h3>
            <ol>
                <li>Drive up to the entrance gate.</li>
                <li>When your car is directly in front of the gate, click the "Enter Garage" button.</li>
                <li>Stay with us as long as you like and pay through this website when you are about to leave.</li>
                <li>Thank you for choosing Parking Place!</li>
            </ol>
            <form>
                <button type="submit" class="btn btn-primary" @click.prevent="enter">Enter Garage</button>
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
            enter() {
                axios.post('/api/entries')
                    .then(response => {
                        //tell parent userEnteredGarage and pass the updated currentTicket
                        this.$emit('userEnteredGarage', response.data);
                    });
            }
        }
    
    }
</script>
