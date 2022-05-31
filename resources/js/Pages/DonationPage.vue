<template>
    <public-app-layout title="Soorya Foundation" :show-over="false">
        <div class="donation-bg bg-cover">
            <div class="bg-black h-72 w-full bg-opacity-80 flex items-center">
            <h1 class="font-bold text-gray-50 text-6xl poppins-font text-center mx-auto">
                Your help matters.
                <h2 class="text-4xl mt-3">No matter how big or small.</h2>
            </h1></div>
        </div>
        <div class="p-4 max-w-7xl mx-auto">
            <h3 class="pt-10 pb-12 font-bold text-center poppins-font text-3xl">Select the project</h3>
            <donation-block @selectBlock="getSelectedBlock" :donations="donations"></donation-block>
            <h3 class="pt-12 font-bold text-center poppins-font text-3xl">Select the amount</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8 mt-14 poppins-font">
                <div class="border border-4  rounded-2xl h-24 text-center text-2xl items-center flex cursor-pointer"
                     @click="selectAmount(amount)"
                     :class="{'border-blue-700':(amount === selectedAmount)}"
                     v-for="amount in [5, 10,20,50, 100, 'Other']">
                    <div class="mx-auto px-3">
                        <template v-if="amount !== 'Other'">$</template>
                        {{ amount }}
                        <input
                            class="w-full text-center border"
                            :class="amountCss"
                            @change=""
                            v-model="customAmount" v-if="amount === 'Other' && showCustomAmount">
                    </div>
                </div>
            </div>
            <div class="my-8 text-right">
                <pay-pal-button :amount="paymentAmount" v-if="showButton"></pay-pal-button>
            </div>
        </div>
    </public-app-layout>
</template>

<script setup>

import PublicAppLayout from "@/Layouts/PublicAppLayout";

import {onMounted, computed, watch, ref} from 'vue'

import DonationBlock from "../Components/DonationBlock";
import Input from "../Jetstream/Input";
import PayPalButton from "../Components/PayPalButton";

const donations = [{
    title: "Primary School Developments",
    description: "We have selected 100 rural schools which they need aids and currently we have completed 90 successful projects",
    image: "/images/donation/donation-1.jpg",
    raised: 34000,
    target: 40000,
    currency: "$",
    color: "#d3611f",
    publicId: "11c03776-c077-457a-8d72-17808e706687"
}, {
    title: "Technical Collage Build",
    description: "We are building Monaragala international cultural center and technical college for young generations skills",
    image: "/images/donation/donation-2.jpg",
    raised: 67000,
    target: 216000,
    currency: "$",
    color: "#fb59a5",
    publicId: "ff8af75c-b668-498b-8456-9abc8a0e070a"
}]

let customAmount = ref("");
let selectedAmount = ref(20);
let showCustomAmount = ref(false);
let hasAmountError = ref(false)
let showButton = ref(true)
let selectedBlock = ref({})

let paymentAmount = computed(() => {
    if (showCustomAmount.value) {
        console.log("came 1")
        if (isNaN(customAmount.value)) {
            console.log("came 2")
            console.log("isNumber(customAmount.value)", isNaN(customAmount.value), "customAmount.value", customAmount.value)
            hasAmountError.value = true;
        }
        console.log("came 4")

        return customAmount.value
    }
    console.log("came 5")
    hasAmountError.value = false;
    return selectedAmount.value
});

function getSelectedBlock(publicId) {
    selectedBlock.value = donations.find(el => el.publicId === publicId)
}

function amountCss() {
    return hasAmountError.value ? 'border-red-700' : 'border-gray-400'
}

function selectAmount(amount) {
    selectedAmount.value = amount;
    showCustomAmount.value = amount === "Other"
}

function logMe() {
    console.log("paymentAmount", paymentAmount.value)
}

onMounted(() => {
    // paypalButtonRender();
})

watch(paymentAmount, (newVal, prevVal) => {
    console.log("paymentAmount", paymentAmount)
    showButton.value = true;
})


</script>

<style>
.donation-bg{
    background: url("/images/donation/donation-bg.jpg") no-repeat center center;
    background-size: cover;
}
</style>
