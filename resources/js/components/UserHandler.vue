<template>
    <div>
        <enter-garage-form 
            v-if="showEnterGarageForm"
            @userEnteredGarage="enterGarage"></enter-garage-form>

        <exit-garage-form 
            v-if="showExitGarageForm"
            @userExitedGarage="exitGarage"></exit-garage-form>

        <checkout-form 
            v-if="showCheckoutForm"
            @userHasPaid="hasPaid"></checkout-form>

        <ticket-information
            v-if="showTicketInformation"></ticket-information>
        
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    isInside: false,
                    hasPaid: false,
                }
            }
        },

        created() {
            this.updateUser();
        },

        methods: {
            updateUser: function () {
                axios.get('/api/users/current')
                    .then(response => {
                        this.user = response.data.data;
                    });
            },

            enterGarage: function () {
                this.user.isInside = true;
            },

            hasPaid: function () {
                this.user.hasPaid = true;
            },

            exitGarage: function () {
                this.user.isInside = false;
                this.user.hasPaid = false;
            }
        },

        computed: {
            showEnterGarageForm: function() {
                return ! this.user.isInside;
            },

            showCheckoutForm: function() {
                return this.user.isInside && ! this.user.hasPaid;
            },

            showExitGarageForm: function() {
                return this.user.isInside && this.user.hasPaid;
            },

            showTicketInformation: function() {
                return this.user.isInside;
            }
        }
    
    }
</script>
