<template>
    <form action="purchases" method="POST">
        <input type="hidden" name="stripeToken" v-model="form.stripeToken">
        <input type="hidden" name="stripeEmail" v-model="form.stripeEmail">

        <button type="submit" @click.prevent="buy">Pay for Parking</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    stripeEmail: '',
                    stripeToken: '',
                }
            }
        },

        created() {
            this.stripe = StripeCheckout.configure({
                key: ParkingPlace.stripeKey,
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                token: (token) => {
                    this.form.stripeToken = token.id;
                    this.form.stripeEmail = token.email;

                    axios.post('/api/purchases', this.$data.form)
                        .then(response => alert(response.data));
                }
            });
        },

        methods: {
            buy() {
                this.stripe.open({
                    name: 'Parking Place',
                    description: 'Some Parking Rate',
                    zipCode: true,
                    amount: 100,
                });
            }
        }
    
    }
</script>
