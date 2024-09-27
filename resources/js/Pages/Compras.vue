<template>
    <AppLayout>

        <Head title="Compras" />
        <div class="px-4 sm:px-6 lg:px-8">

            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Compras</h1>
                    <p class="mt-2 text-sm text-gray-700">Aqui esta el listado de todas las compras.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button type="button" @click="show = true"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Nueva
                        Compra</button>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">
                                        Nombre</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Precio</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Categorias</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Descripción</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                        <span>Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr v-for="product in products" class="even:bg-gray-50">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                        {{ product.name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                        formatCurrency(product.price) }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                        product.categories.map(category => category.name).join(', ') }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.description
                                        }}</td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                class="sr-only">, {{ 'HOla' }}</span></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <Modal v-model:visible="show">

                <div class="flex flex-col gap-y-4">
                    <h2 class="text-xl font-bold">Agregar Compra</h2>
                    <form @submit="submitForm" class="space-y-4">
                        <Input v-model="formBuy.supplier_name" label="Nombre del Proveedor" type="text" required />
                        <Input v-model="formBuy.supplier_email" label="Email del Proveedor" type="number" required />
                        <div class="flex flex-col">
                            <label for="" class="text-sm font-bold mb-1">Seleccionar Productos</label>
                            <multiselect :multiple="true" :close-on-select="false" label="name" track-by="name"
                                v-model="formBuy.products" :options="products" :preserve-search="true"
                                placeholder="Seleccionar Categorias"></multiselect>
                        </div>
                        <button type="submit"
                            class="text-green-800 border border-green-800 p-2 rounded-md shadow-md w-full hover:bg-green-800 hover:text-white">Enviar</button>
                    </form>
                </div>
            </Modal>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
import { Head, Link, InertiaForm, useForm } from '@inertiajs/vue3'
import { useBuyStore } from "@/Stores/buy.js";
import { storeToRefs } from "pinia";
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import Input from '@/Components/Input.vue';
import Multiselect from 'vue-multiselect'

interface Category {
    name: string,
    id: number
}

interface Product {
    name: string,
    price: number,
    categories: Array<Category>,
}

interface Buy {
    supplier_name: string;
    supplier_email: string;
    products: Array<Product>;
}

const store = useBuyStore();
const { formBuy } = storeToRefs(store);

const show: Ref<boolean> = ref(false);

const props = defineProps<{
    products: Array<any>,
    buys: Array<Buy>
}>();

function submitForm(event: Event): void {
    event.preventDefault();
    formBuy.value.transform((data: { name: string, price: number, categories: Array<Category> }) => ({
        ...data,
        categories: data.categories.map((category: Category) => category.id)
    })).post('products', {
        onSuccess: () => {
            show.value = false;
            formBuy.value.reset();
        }
    });
}

function formatCurrency(value: number): string {
    return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(value);
}

</script>