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
                    <tr v-show="! this.ticket.isPaid">
                        <td><strong>Amount Currently Oweing:</strong></td>
                        <td>{{ this.amountOweing }}</td>
                    </tr>
                    <tr v-show="this.ticket.isPaid">
                        <td><strong>Amount Paid:</strong></td>
                        <td>{{ this.amountPaid }}</td>
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
        props: ['initialTicket'],

        data() {
            return {
                ticket: {}
            }
        },

        created() {
            this.ticket = this.initialTicket;
        },

        watch: {
            initialTicket: function (ticket) {
                this.ticket = ticket;
            }
        },

        methods: {
            toDollarString (amount) {
                return (amount / 100).toLocaleString("en-CA", {style:"currency", currency:"CAD"});
            }
        },

        computed: {
            enteredAt: function () {
                return this.ticket.entered_at;
            },

            paidAt: function () {
                return this.ticket.paid_at ? this.ticket.paid_at : null;
            },

            amountOweing: function () {
                return this.ticket.rate ? this.toDollarString(this.ticket.rate.amount) : null;
            },

            amountPaid: function () {
                return this.ticket.paid_amount ? this.toDollarString(this.ticket.paid_amount) : null;
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
