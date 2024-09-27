import { defineStore } from "pinia";
import { ref } from 'vue';
import type { Ref } from 'vue';
import { InertiaForm, useForm } from '@inertiajs/vue3';

export const useSaleStore = defineStore('sale', () => {
    interface Category {
        id: number;
        name: string;
    }
    interface Product {
        product_id: number;
        quantity: string;
    }

    const formSale: InertiaForm<{
        supplier_name: string;
        supplier_email: string;
        products: Array<Product>;
    }> = useForm({
        supplier_name: "",
        supplier_email: "",
        products: [],
    })

    return { formSale }
},
    {
        persist: {
            storage: sessionStorage,
            paths: ["formSale"],
        },
    }
)