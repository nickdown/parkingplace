<template>
    <div class="card mt-3">
        <div class="card-header">Ticket Information</div>

        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Ticket Status:</strong></td>
                        <td>{{ this.status }}</td>
                    </tr>
                    <tr>
                        <td><strong>Entered At:</strong></td>
                        <td>{{ this.enteredAt }}</td>
                    </tr>
                    <tr v-show="this.paidAt">
                        <td><strong>Paid At:</strong></td>
                        <td>{{ this.paidAt }}</td>
                    </tr>
                    <tr>
                        <td><strong>Amount Currently Oweing:</strong></td>
                        <td>{{ this.amountOweing }}</td>
                    </tr>
                    <tr>
                        <td><strong>Ticket Description:</strong></td>
                        <td>{{ this.description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer" v-show="! this.ticket.isPaid">
            Continued usage will accrue additional charges.
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ticket: {}
            }
        },

        created() {
            this.refreshTicket();
        },

        methods: {
            refreshTicket() {
                axios.get('/api/tickets/current')
                    .then(response => {
                        this.ticket = response.data.data;
                    });
            },

            toDollarString(amount) {
                return (amount / 100).toLocaleString("en-CA", {style:"currency", currency:"CAD"});
            }
        },

        computed: {
            enteredAt: function() {
                return this.ticket.entered_at;
            },

            paidAt: function() {
                return this.ticket.paid_at ? this.ticket.paid_at : null;
            },

            amountOweing: function () {
                return this.ticket.rate ? this.toDollarString(this.ticket.rate.amount) : null;
            },

            description: function () {
                return this.ticket.rate ? this.ticket.rate.description : null;
            },

            status: function () {
                return this.ticket.isPaid ? "Paid" : "Unpaid";
            }
        }
    }
</script>
