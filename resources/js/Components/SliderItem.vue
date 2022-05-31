<template>
    <div class="bg-no-repeat bg-cover" :style="bgClass">
        <div class="from-black bg-gradient-to-b bg-opacity-5">
            <div class="poppins-font text-white flex items-center min-h-screen max-w-7xl mx-auto px-4 lg:px-8">
                <div class="">
                    <h2 class="text-6xl font-extrabold pr-60">{{ title }}</h2>
                    <p class="mt-6 text">{{ description }}</p>

                    <div class="mt-12">
                        <a class="bg-amber-500 py-3 px-6 rounded-full mr-6" href="#" tabindex="0"> <i class=""></i><span>Donate Fund</span></a>
                        <a class="bg-gray-100 py-3 px-6 rounded-full text-gray-900" href="#" tabindex="0"><i class=""></i><span>Learn More</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    title: String,
    description: String,
    image: String
});

let bgClass = {backgroundImage: `url(/images/sliders/${props.image})`}

</script>


