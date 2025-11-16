<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import CreateOfertaForm from './../Ofertas/Create.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

defineProps({
    ofertas: Array,
});

const showingCreateModal = ref(false);

const openCreateModal = () => {
    showingCreateModal.value = true;
};

const closeModal = () => {
    showingCreateModal.value = false;
};
</script>

<template>
    <AppLayout title="Mis Ofertas de Trabajo">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Mis Ofertas de Trabajo
                </h2>
                <SecondaryButton @click="openCreateModal">
                    Crear Nueva Oferta
                </SecondaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="ofertas.length > 0" class="space-y-4">
                        <div v-for="oferta in ofertas" :key="oferta.id" class="p-4 border dark:border-gray-700 rounded-lg flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ oferta.titulo }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ oferta.ubicacion }} - {{ oferta.modalidad }}</p>
                                <p class="text-sm" :class="{'text-green-500': oferta.estado === 'abierta', 'text-red-500': oferta.estado !== 'abierta'}">
                                    Estado: {{ oferta.estado }}
                                </p>
                            </div>
                            <Link :href="route('ofertas.show', oferta.id)" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                Ver Detalles
                            </Link>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-gray-500 dark:text-gray-400">Aún no has creado ninguna oferta de trabajo.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Crear Oferta -->
        <CreateOfertaForm :show="showingCreateModal" @close="closeModal" />
    </AppLayout>
</template>