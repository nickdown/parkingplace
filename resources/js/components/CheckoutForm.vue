<template>
    <div class="card">
        <div class="card-header">Are you ready to leave?</div>

        <div class="card-body">
            <div v-if="! this.processing">
                <form action="purchases" method="POST">
                    <input type="hidden" name="stripeToken" v-model="form.stripeToken">
                    <input type="hidden" name="stripeEmail" v-model="form.stripeEmail">

                    <button type="submit" class="btn btn-primary" @click.prevent="buy">Pay for Parking</button>
                </form>
            </div>
            <div v-if="this.processing" class="d-flex justify-content-center">
                Processing... please wait.
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['initialTicket'],

        data() {
            return {
                form: {
                    stripeEmail: '',
                    stripeToken: '',
                },
                ticket: {},
                processing: false,
            }
        },

        created() {
            this.ticket = this.initialTicket;

            this.stripe = StripeCheckout.configure({
                key: ParkingPlace.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                email: ParkingPlace.userEmail,                
                token: (token) => {
                    this.form.stripeToken = token.id;
                    this.form.stripeEmail = token.email;

                    this.processing = true;
                    axios.post('/api/purchases', this.$data.form)
                        .then(response => {
                            this.processing = false;
                            this.$emit('userHasPaid');
                        });
                }
            });
        },

        watch: {
            initialTicket: function(ticket) {
                this.ticket = ticket;
            }
        },

        methods: {
            buy() {
                this.stripe.open({
                    name: 'Parking Place',
                    description: this.ticket.rate.description,
                    zipCode: false,
                    allowRememberMe: false,
                    amount: this.ticket.rate.amount,
                });
            }
        }
    
    }
</script>
