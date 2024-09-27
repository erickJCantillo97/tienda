<template>
    <AppLayout>

        <Head title="Productos" />
        <div class="px-4 sm:px-6 lg:px-8">

            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Categorias</h1>
                    <p class="mt-2 text-sm text-gray-700">Aqui esta el listado de todas las categorias.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <button type="button" @click="show = true"
                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Nueva Categoria</button>
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
                                        Cantidad de Productos</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-3">
                                        <span>Acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-for="c in categories" class="bg-white">
                                <tr class="even:bg-gray-50">
                                    <td
                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">
                                        {{ c.name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ c.count_products }}</td>
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
                    <h2 class="text-xl font-bold">Agregar Categoria de producto</h2>
                    <form @submit="save" class="space-y-4">
                        <Input v-model="formProduct.name" label="Nombre" />
                        <button type="submit" class="text-green-800 border border-green-800 p-2 rounded-md shadow-md w-full hover:bg-green-800 hover:text-white">Enviar</button>
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
import { useCategoryStore } from "@/Stores/categories.js";
import { storeToRefs } from "pinia";
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import Input from '@/Components/Input.vue';

const store = useCategoryStore();
const { formProduct } = storeToRefs(store);

const show: Ref<boolean> = ref(false);

const props = defineProps({
    categories: {
        type: Array,
        required: true,
        default: []
    }
});

function save(event: Event): void {
    event.preventDefault();
    formProduct.value.post('/categories');
    show.value = false;
}
</script>