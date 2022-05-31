<template>
    <div class="p-24 max-w-5xl mx-auto">
        <div class="grid grid-cols-2 gap-4">
            <div class="grid grid-cols-4" v-for="news in newsList">
                <div class="col-span-1">
                    <div class="w-full bg-gray-400 rounded-l">
                        <img :src="news.image" class="object-cover h-24" :alt="news.title">
                    </div>
                </div>
                <div class="col-span-3 px-4 poppins-font">
                    <h4 class="font-bold text-gray-600">{{ news.title }} </h4>
                    <div class="text-gray-400">{{news.description}}</div>
                    <div class="text-gray-500 text-sm">
                        <calendar-icon size="14" class="inline-block -mt-0.5"></calendar-icon> <span class="inline-block"> {{news.date}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import {CalendarIcon} from 'vue-tabler-icons'

const newsList = [
    {title: "The testing news 1", date:"2022-02-22", description:"This is first and best description of the day", image:"/images/news/1.jpg"},
    {title: "The testing news 2", date:"2022-02-22", description:"This is the description", image:"/images/news/1.jpg"},
    {title: "The testing news 3", date:"2022-02-22", description:"This is the description", image:"/images/news/1.jpg"},
    {title: "The testing news 4", date:"2022-02-22", description:"This is the description", image:"/images/news/1.jpg"},
    {title: "The testing news 5", date:"2022-02-22", description:"This is the description", image:"/images/news/1.jpg"},
    {title: "The testing news 6", date:"2022-02-22", description:"This is the description", image:"/images/news/1.jpg"},
]
</script>

<style scoped>

</style>
