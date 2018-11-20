<template>
    <form action="purchases" method="POST">
        <input type="hidden" name="stripeToken" v-model="stripeToken">
        <input type="hidden" name="stripeEmail" v-model="stripeEmail">

        <button type="submit" @click.prevent="buy">Pay for Parking</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                stripeEmail: '',
                stripeToken: '',
            }
        },

        created() {

            axios.get('/api/amen')
                .then(response => alert('hmm'));
                
            this.stripe = StripeCheckout.configure({
                key: "pk_test_7O13bFRx1WGDjQEYqotv9vkl",
                image: "https://stripe.com/img/documentation/checkout/marketplace.png",
                locale: "auto",
                token: function (token) {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;

                    axios.post('/api/purchases', this.$data)
                        .then(response => alert('Complete! Thanks for paying!'));
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
