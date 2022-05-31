<template>
    <div class="poppins-font text-center max-w-7xl lg:px-8 py-24 mx-auto">
        <div class="text-amber-600 text-2xl font-bold">Welcome to</div>
        <h1 class="text-5xl font-bold">Soorya Foundation</h1>
        <p class="mt-8">
            Soorya Foundation was established in 2009, which was found by Sooriyagoda Jinasiri Thero. The main purpose of this foundation was to help people in need and to organize
            Buddhist programs,
        </p>
        <div class="flex columns-4 justify-center space-x-6 mt-16">
            <div class="border rounded shadow p-8" v-for="text in [1,2,3,4]">Text going here {{text}}</div>
        </div>
    </div>

</template>

<script setup>

</script>
