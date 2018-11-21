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
            :initialTicket="this.ticket"
            @userHasPaid="hasPaid"></checkout-form>

        <ticket-information
            :initialTicket="this.ticket"
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
                },
                ticket: {},
                timer: ''
            }
        },

        created() {
            // get data from server and refresh every 30 seconds
            this.refreshData();
            this.timer = setInterval(this.refreshData, 30*1000);
        },

        beforeDestroy() {
            clearInterval(this.timer)
        },
        

        methods: {
            refreshData: function () {
                this.refreshTicket();
                this.refreshUser();
            },

            refreshUser: function () {
                axios.get('/api/users/current')
                    .then(response => {
                        this.user = response.data.data;
                    });
            },

            refreshTicket: function () {
                axios.get('/api/tickets/current')
                    .then(response => {
                        this.ticket = response.data.data;
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
