<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
import { Head, Link, InertiaForm, useForm } from '@inertiajs/vue3';
import { useProductsStore } from "@/Stores/products.js";
import { storeToRefs } from "pinia";

const store = useProductsStore();
const { formProduct } = storeToRefs(store);

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form: InertiaForm<{
    email: string;
    password: string;
    password_confirmation: string;
    name: string;
}> = useForm({
    email: "",
    password: "",
    password_confirmation: "",
    name: '',
})




const passwordErrorMessage: Ref<string> = ref('');

function submit(): void {
    form.post('/register', {

    });
};
</script>

<template>

    <Head title="HelpSmart - Login" />

    <div class="min-h-screen flex flex-col items-center justify-center bg-blue-600">
        <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
            <span class="font-medium self-center text-xl sm:text-2xl text-center text-gray-800">Registro en Tienda
                HelpSmart</span>

            <form @submit.prevent="submit" class="space-y-4 flex flex-col mt-4">
                <div class="flex flex-col">
                    <label for="name" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Nombre</label>
                    <div class="relative items-center">
                        <div class="flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-6" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </span>
                        </div>
                        <input id="email" v-model="form.name" type="text" required name="name"
                            class="text-sm text-black sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                            placeholder="Nombre" />
                    </div>
                </div>
                <div class="flex flex-col">

                    <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Correo</label>
                    <div class="relative items-center">
                        <div class="flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="size-6" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </span>
                        </div>
                        <input id="email" v-model="form.email" type="email" required name="email"
                            class="text-sm text-black sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                            placeholder="Ingrese su Email" />
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Contraseña</label>
                    <div class="relative items-center">
                        <div class="flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                            <span>
                                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                        </div>
                        <input v-model="form.password" id="password" type="password" name="password"
                            class="text-sm text-black sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                            placeholder="Ingrese su Contraseña" />
                    </div>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Confirmar
                        Contraseña</label>
                    <div class="relative items-center">
                        <div class="flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                            <span>
                                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                        </div>
                        <input v-model="form.password_confirmation" id="password" type="password" name="password"
                            class="text-sm text-black sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                            placeholder="Ingrese Contraseña de nuevo" />
                    </div>
                </div>

                <div class="flex w-full">
                    <button type="submit"
                        class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-600 hover:bg-blue-700 rounded py-2 w-full transition duration-150 ease-in">
                        <span class="mr-2 ">Registro</span>
                        <span>
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
            <div class="text-center mt-2">
                <div class="relative flex py-5 items-center">
                    <div class="flex-grow border-t border-gray-400"></div>
                    <span class="flex-shrink mx-4 text-gray-400">Si ya tiene una cuenta</span>
                    <div class="flex-grow border-t border-gray-400"></div>
                </div>
            </div>
            <div class="flex justify-center mt-2 gap-x-4">
                <a href="login"
                    class="border p-1 px-3 hover:text-white hover:bg-blue-800 rounded-lg border-blue-800 text-blue-800">Inciar
                    Sesión</a>
            </div>
        </div>
    </div>
</template>
