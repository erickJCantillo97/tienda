<template>
    <div class="flex flex-col gap-y-1">
        <label for="" class="text-sm font-bold">{{label}}</label>

        <input :type="type" v-model="input"  class="py-2 px-1.5 rounded-md shadow border-b border ring-1 ring-blue-300 focus:ring focus:ring-blue-300">
    </div> 
</template>
<script setup lang="ts">
import { Ref } from 'vue';


const props = defineProps<{
    label: string,
    type: string,
}>()
const input = defineModel()
</script>