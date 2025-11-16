<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DialogModal from '@/Components/DialogModal.vue';
import CreateCvForm from './Components/CreateCvForm.vue'; // Importamos el formulario
import {
    BriefcaseIcon,
    AcademicCapIcon,
    SparklesIcon,
    CurrencyDollarIcon,
    ClockIcon,
    LinkIcon,
    DocumentArrowDownIcon,
    PlusCircleIcon
} from '@heroicons/vue/24/outline';

defineProps({
    cvs: {
        type: Array,
        default: () => []
    }
});

const showCreateModal = ref(false);

const openCreateModal = () => {
    showCreateModal.value = true;
};

const closeCreateModal = () => {
    showCreateModal.value = false;
};

const formatSalary = (amount) => {
    if (!amount) return 'No especificada';
    return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(amount);
};
</script>

<template>
    <AppLayout title="Mis Currículums">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Mis Currículums
                </h2>
                <!-- El botón ahora abre el modal -->
                <button @click="openCreateModal" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    <PlusCircleIcon class="w-5 h-5 mr-2" />
                    Crear Nuevo CV
                </button>
            </div>
        </template>

        <div class="py-12">
            <!-- ... (el resto del template de la lista de CVs se mantiene igual) ... -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="cvs.length === 0" class="text-center bg-white overflow-hidden shadow-xl sm:rounded-lg p-12">
                    <h3 class="text-lg font-medium text-gray-900">Aún no tienes ningún currículum</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Crea tu primer CV para empezar a aplicar a las mejores ofertas.
                    </p>
                    <div class="mt-6">
                        <button @click="openCreateModal" type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <PlusCircleIcon class="w-5 h-5 mr-2" />
                            Crear mi primer CV
                        </button>
                    </div>
                </div>

                <div v-else class="space-y-8">
                    <div v-for="(cv, index) in cvs" :key="cv.id" class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Currículum #{{ index + 1 }}</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Columna Izquierda -->
                            <div>
                                <div class="flex items-center mb-3">
                                    <BriefcaseIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <p><span class="font-semibold">Experiencia Total:</span> {{ cv.experiencia_total || 0 }} años</p>
                                </div>
                                <div class="flex items-center mb-3">
                                    <CurrencyDollarIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <p><span class="font-semibold">Pretensión Salarial:</span> {{ formatSalary(cv.pretension_salarial) }}</p>
                                </div>
                                <div class="flex items-center mb-3">
                                    <ClockIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <p><span class="font-semibold">Disponibilidad:</span> {{ cv.disponibilidad || 'No especificada' }}</p>
                                </div>
                                <div v-if="cv.portafolio_url" class="flex items-center">
                                    <LinkIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <a :href="cv.portafolio_url" target="_blank" class="text-blue-600 hover:underline">Ver Portafolio</a>
                                </div>
                            </div>

                            <!-- Columna Derecha -->
                            <div>
                                <div class="mb-4">
                                    <h4 class="font-semibold text-gray-800 mb-2 flex items-center"><SparklesIcon class="w-5 h-5 mr-2 text-indigo-500"/>Skills</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span v-for="skill in cv.skills" :key="skill" class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">{{ skill }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-2 flex items-center"><AcademicCapIcon class="w-5 h-5 mr-2 text-green-500"/>Educación</h4>
                                    <ul class="list-disc list-inside text-gray-700">
                                        <li v-for="edu in cv.educacion" :key="edu.institucion">{{ edu.carrera }} en {{ edu.institucion }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t flex justify-end gap-4">
                            <button class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Editar</button>
                            <a v-if="cv.cv_path" :href="cv.cv_path" download class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-900">
                                <DocumentArrowDownIcon class="w-5 h-5 mr-1" />
                                Descargar PDF
                            </a>
                            <button class="text-sm font-medium text-red-600 hover:text-red-900">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Crear CV -->
        <DialogModal :show="showCreateModal" @close="closeCreateModal">
            <template #title>
                Crear Nuevo Currículum
            </template>
            <template #content>
                <CreateCvForm @close="closeCreateModal" />
            </template>
        </DialogModal>
    </AppLayout>
</template>