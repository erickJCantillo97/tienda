import { defineStore } from "pinia";
import { ref } from 'vue';
import type { Ref } from 'vue';
import { InertiaForm, useForm } from '@inertiajs/vue3';

export const useCategoryStore = defineStore('category', () => {
    const formProduct: InertiaForm<{
        name: string;
    }> = useForm({
        name: "",
    })

    return {formProduct}
},
{
    persist: {
        storage: sessionStorage,
        paths: ["formCategory"],
    },
}
)