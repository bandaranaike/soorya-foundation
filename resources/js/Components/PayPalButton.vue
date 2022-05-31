<template>
    <div id="paypal-button"></div>
</template>

<script setup>
import {onMounted} from "vue";

const state = {}

let props = defineProps({
    amount: {
        default: 0,
        type: Number
    }
})

onMounted(() => {
    paypalButtonRender();
})

function paypalButtonRender() {
    paypal.Button.render({
        env: 'sandbox', // Optional: specify 'sandbox' environment
        client: {
            sandbox: 'ARaRApLpCcwXoS7e7Tj2jTgXlKM9sOF-60ioXCMTMAnhvzSguXAp1-3eYUecsSpMaPVwk4LlaBsDY2Ig',
            production: 'xxxx'
        },
        locale: 'en_US',
        style: {
            size: 'large',
            color: 'white',
            shape: 'pill',
            label: 'paypal',
            tagline: 'false',
        },
        commit: false, // Optional: show a 'Pay Now' button in         the checkout flow
        payment: function (resolve, reject) {
            // Set up the payment here, when the buyer clicks             on the button

            let returnUrl = "http://localhost/execute-paypal";

            //Here call your own API server
            return new Promise((resolve, reject) => {
                axios.post('/checkout-paypal', {
                    return_url: returnUrl,
                    amount: props.amount
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + state.token
                    }
                })
                    .then(res => {
                        resolve(res.data.id)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })

        },
        onAuthorize: function (data) {
            // Execute the payment here, when the buyer approves             the transaction

            return new Promise((resolve, reject) => {
                axios.post('/execute-paypal', {
                    payer_id: data.payerID,
                    payment_id: data.paymentID,
                }, {
                    headers: {'Authorization': 'Bearer ' + state.token}
                })
                    .then(res => {
                        resolve(res)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })

        }
    }, '#paypal-button')
}
</script>

<style>

</style>
