<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import OfertaList from './Ofertas/Components/ListaOfertas.vue';

defineProps({
    ofertas: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Candidato
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <OfertaList :ofertas="ofertas" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>