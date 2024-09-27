import { defineStore } from "pinia";
import { ref } from 'vue';
import type { Ref } from 'vue';
import { InertiaForm, useForm } from '@inertiajs/vue3';

export const useProductsStore = defineStore('product', () => {
    const formProduct: InertiaForm<{
        name: string;
        price: number;
        categories: Array<number>;
    }> = useForm({
        name: "",
        price: 0,
        description: '',
        categories: [],
    })

    return {formProduct}
},
{
    persist: {
        storage: sessionStorage,
        paths: ["formProduct"],
    },
}
)