<template>
    <div class="card">
        <div class="card-header">You are still in the Garage.</div>

        <div class="card-body d-flex justify-content-center">
            <div v-if="! this.processing" class="d-flex flex-column justify-content-center text-center">
                <h3>Please pay for parking when you are ready to leave the garage.</h3>
                <form action="purchases" method="POST">
                    <input type="hidden" name="stripeToken" v-model="form.stripeToken">
                    <input type="hidden" name="stripeEmail" v-model="form.stripeEmail">

                    <button type="submit" class="btn btn-primary btn-lg" @click.prevent="buy">Pay for Parking</button>
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
                            alert("You have successfully paid.");
                            
                            // tell parent userHasPaid and pass the updated currentTicket
                            this.$emit('userHasPaid', response.data);
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
