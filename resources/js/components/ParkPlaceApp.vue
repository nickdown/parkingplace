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
            :initialTicket="this.user.currentTicket"
            @userHasPaid="hasPaid"></checkout-form>

        <ticket-information
            :initialTicket="this.user.currentTicket"
            v-if="showTicketInformation"></ticket-information>
        
        
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {},
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
                this.refreshUser();
            },

            refreshUser: function () {
                axios.get('/api/users/current')
                    .then(response => {
                        this.user = response.data.data;
                    });
            },

            enterGarage: function (currentTicket) {
                this.user.isInside = true;
                this.user.currentTicket = currentTicket.data;
            },

            hasPaid: function (currentTicket) {
                this.user.currentTicket = currentTicket.data;
            },

            exitGarage: function (currentTicket) {
                this.user.isInside = false;
                this.user.currentTicket = currentTicket.data;
            }
        },

        computed: {
            showEnterGarageForm: function() {
                return ! this.user.isInside;
            },

            showCheckoutForm: function() {
                return this.user.isInside && ! this.ticketIsPaid;
            },

            showExitGarageForm: function() {
                return this.user.isInside && this.ticketIsPaid;
            },

            showTicketInformation: function() {
                return this.user.isInside;
            },

            ticketIsPaid: function () {
                return this.user.currentTicket ? this.user.currentTicket.isPaid : false;
            }
        }
    
    }
</script>
