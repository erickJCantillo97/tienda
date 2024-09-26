<script setup lang="ts">
import { ref } from 'vue';
import type { Ref } from 'vue';
import { Head, Link, InertiaForm, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form: InertiaForm<{
    email: string;
    password: string;
    remember: boolean;
}> = useForm({
    email: "",
    password: "",
    remember: false,
})




const passwordErrorMessage: Ref<boolean> = ref(false);

function submit(): void {
    form.transform((data: any): void => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post('/login', {
        onFinish(): void {
            form.reset('password');
            passwordErrorMessage.value = 'La contraseña es incorrecta';
        },
    });
};
</script>

<template>

    <Head title="HelpSmart - Login" />

    <div class="min-h-screen flex flex-col items-center justify-center bg-blue-600">
        <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
            <span class="font-medium self-center text-xl sm:text-2xl text-center text-gray-800">Tienda HelpSmart</span>
            <form @submit.prevent="submit" class="space-y-4 flex flex-col">
                <div class="flex flex-col">
                    <span
                        :class="{ 'invisible': !passwordErrorMessage && !form.errors.email, 'visible': passwordErrorMessage && form.errors.email }"
                        class="min-h-[1rem] mt-2 text-red-600">Estas credenciales son incorrectas, revise si esta
                        ingresando su usuario y contraseña correctamente.</span>
                    <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Usuario</label>
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
                        <input id="email" v-model="form.email" type="text" name="email"
                            class="text-sm text-black sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                            placeholder="Ingrese su Usuario" />
                    </div>
                    <!-- Espacio reservado para el mensaje de error -->


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
                    <!-- Espacio reservado para el mensaje de error -->
                    <!-- <span :class="{'invisible': !passwordErrorMessage, 'visible': passwordErrorMessage}" class="min-h-[1rem] mt-2 text-red-600">La contraseña es incorrecta!</span> -->
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mb-4 flex items-center">
                    <input type="checkbox" v-model="form.remember" id="remember" name="remember"
                        class="text-blue-500 rounded-md">
                    <label for="remember" class="text-gray-600 ml-2">Recordar Datos</label>
                </div>

                <div class="flex w-full">
                    <button type="submit"
                        class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-600 hover:bg-blue-700 rounded py-2 w-full transition duration-150 ease-in">
                        <span class="mr-2 uppercase">Entrar</span>
                        <span>
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
