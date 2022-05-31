<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 poppins-font">
        <div class="border border-2 border-gray-300 rounded"
             :class="{'border-blue-700':(selectedBlock === donation.publicId)}"
             v-for="donation in donations"
             @click="selectTheBlock(donation.publicId)">
            <img :src="donation.image" class="w-full object-contain rounded-t" alt="Image">
            <div class="p-5">
                <h3 class="text-3xl mb-4">{{ donation.title }}</h3>
                <p>{{ donation.description }}</p>
            </div>
            <div class="border-t border-gray-300 p-5">
                <div class="">
                    <progress-bar :current-value="Math.round((donation.raised/donation.target) * 100)" class="mb-2" :color="donation.color"></progress-bar>
                    <div class="grid grid-cols-2 text-center">
                        <div class="">
                            <div>Raised</div>
                            <div class="text-2xl">{{ donation.currency + donation.raised }}</div>
                        </div>
                        <div class="">
                            <div>Target</div>
                            <div class="text-2xl">{{ donation.currency }}{{ donation.target }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {computed, ref} from 'vue';
import ProgressBar from "vue-3-simple-progress-bar";

let selectedBlock = ref(prop.donations[0].publicId)

const prop = defineProps({
    donations: {
        type: Array,
        default: []
    }
});

const emit = defineEmits(["selectBlock"])

function selectTheBlock(publicId) {
    selectedBlock.value = publicId
    emit("selectBlock", publicId)
    console.log("came", publicId)
}

</script>

<style scoped>

</style>
