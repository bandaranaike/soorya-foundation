<template>
    <public-app-layout title="Japanese Language Vocational Training Course" :show-over="false">
        <div class="bg-gray-100 text-center poppins-font">
            <div class="max-w-4xl px-4 py-24 mx-auto">
                <h1 class="mb-16 font-bold text-5xl">Japanese Language vocational training course</h1>

                <div class="mb-6">
                    <popper class="light" arrow :content="errors.name" :show="errors.name !== ''">

                        <input
                            class="border border-gray-300 w-full p-4 rounded"
                            type="text"
                            placeholder="Your Name *"
                            v-model="form.name"
                        />
                    </popper>
                </div>

                <div class="mb-6">
                    <popper class="light" arrow :content="errors.phone" :show="errors.phone !== ''">
                        <input
                            class="border border-gray-300 w-full p-4 rounded"
                            type="text"
                            placeholder="Phone Number *"
                            v-model="form.phone"
                        />
                    </popper>
                </div>

                <div class="mb-6"><i class="fa fa-envelope-o"></i>
                    <popper class="light" arrow :content="errors.email" :show="errors.email !== ''">

                        <input
                            class="border border-gray-300 w-full p-4 rounded"
                            type="text"
                            placeholder="Your Email *"
                            v-model="form.email"
                        />
                    </popper>
                </div>

                <div class="mb-6" id="datepicker">
                    <input
                        class="border border-gray-300 w-full p-4 rounded"
                        type="text"
                        placeholder="Your Age"
                        v-model="form.age"
                    />
                </div>

                <div class="mb-6" id="timepicker">
                    <input
                        class="border border-gray-300 w-full p-4 rounded"
                        type="text"
                        placeholder="Your Address"
                        v-model="form.address"
                    />
                </div>

                <div class="pt-8">
                    <a class="border bg-green-700 text-white px-6 py-3 rounded cursor-pointer" @click="submitForm">Register</a>
                    <inline-loader :is-loading="isFormSubmitting"></inline-loader>
                    <div v-if="isBooked" class="text-green-700 ml-3 inline-block"><i class="fa fa-check-circle"></i> Registered !</div>
                    <div v-if="validationError" class="text-red-700 mt-3 inline-block"><i class="fa fa-warning"></i> {{ validationError }}</div>
                    <div class="mt-12">There are limited seats. Please be hurry.</div>
                </div>
            </div>
        </div>
    </public-app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import Popper from "vue3-popper";
import InlineLoader from "@/Components/InlineLoader";

import PublicAppLayout from "@/Layouts/PublicAppLayout";

export default defineComponent({
    name: "RegistrationForm",
    components: {
        InlineLoader,
        Popper,
        PublicAppLayout
    },
    data() {
        return {
            isFormSubmitting: false,
            isBooked: false,
            errors: {
                name: "",
                phone: "",
                email: ""
            },
            form: {
                name: "",
                email: "",
                phone: "",
                age: "",
                address: ""
            },
            validationError: null,
            hasErrors: false
        }
    },
    methods: {
        submitForm() {
            this.isBooked = false;
            this.validationError = null;

            // Validating name
            if (!this.form.name || this.form.name === "") {
                this.errors.name = "Name field is required!";
                this.hasErrors = true;
            }

            // Validating phone
            if (!this.form.phone || this.form.phone === "") {
                this.errors.phone = "Phone number field is required!";
                this.hasErrors = true;
            }

            // Validating email
            if (!this.form.email && this.form.email === "") {
                this.errors.email = "Email field is required";
                this.hasErrors = true;
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email)) {
                this.errors.email = "Please enter valid email address";
                this.hasErrors = true;
            }

            if (!this.hasErrors) {
                this.isFormSubmitting = true;
                axios.post(route("tc.japanese.form"), this.form).then(r => {
                    this.isBooked = true
                    this.form = {}
                    this.errors = {}
                }).catch(e => {
                    this.validationError = e.message;
                }).finally(() => this.isFormSubmitting = false)
            }
        }
    },
    watch: {
        "form.email": function () {
            this.errors.email = "";
            this.hasErrors = false;
        },
        "form.name": function () {
            this.errors.name = "";
            this.hasErrors = false;
        },
        "form.phone": function () {
            this.errors.phone = "";
            this.hasErrors = false;
        }
    }
})
</script>

<style>
.light {
    min-width: calc(100% + 24px);
    --popper-theme-background-color: #ffffff;
    --popper-theme-background-color-hover: #ffffff;
    --popper-theme-text-color: #9a1b0a;
    --popper-theme-border-width: 1px;
    --popper-theme-border-style: solid;
    --popper-theme-border-color: #eeeeee;
    --popper-theme-border-radius: 6px;
    --popper-theme-padding: 15px 25px;
    --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
}
</style>
