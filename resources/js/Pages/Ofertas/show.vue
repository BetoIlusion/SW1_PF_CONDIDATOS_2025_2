<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {
    BuildingOffice2Icon,
    MapPinIcon,
    CurrencyDollarIcon,
    BriefcaseIcon,
    ClockIcon,
    CalendarDaysIcon,
    SparklesIcon,
    BookmarkIcon
} from '@heroicons/vue/24/outline';
import { computed } from 'vue';

const props = defineProps({
    oferta: {
        type: Object,
        required: true
    }
});

const formatDate = (dateString) => {
    if (!dateString) return 'No especificada';
    return new Date(dateString).toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const salario = computed(() => {
    if (props.oferta.salario_minimo && props.oferta.salario_maximo) {
        return `${props.oferta.salario_minimo} - ${props.oferta.salario_maximo} ${props.oferta.moneda}`;
    }
    return 'A convenir';
});
</script>

<template>
    <AppLayout :title="`Oferta: ${oferta.titulo}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles de la Oferta de Trabajo
            </h2>
        </template>

        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 md:gap-8">

                    <!-- Columna Principal (Izquierda) -->
                    <div class="md:col-span-2 bg-white p-8 rounded-xl shadow-lg">
                        <!-- Encabezado de la oferta -->
                        <div class="flex items-start mb-6">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center mr-6">
                                <BuildingOffice2Icon class="w-8 h-8 text-gray-500" />
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ oferta.titulo }}</h1>
                                <p class="text-md text-gray-600 mt-1">Publicado por: {{ oferta.user.name }}</p>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="prose prose-lg max-w-none text-gray-700 mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 border-b pb-2">Descripción del Puesto</h3>
                            <p>{{ oferta.descripcion }}</p>
                        </div>

                        <!-- Skills -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Habilidades Requeridas</h3>
                            <div class="flex flex-wrap gap-3">
                                <span v-for="skill in oferta.skills_requeridos" :key="skill"
                                    class="flex items-center px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-semibold">
                                    <SparklesIcon class="w-4 h-4 mr-2" />
                                    {{ skill }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Lateral (Derecha) -->
                    <div class="md:col-span-1 mt-8 md:mt-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg sticky top-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Resumen de la Oferta</h3>
                            <ul class="space-y-4 text-gray-700">
                                <li class="flex items-center">
                                    <CurrencyDollarIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <span>{{ salario }}</span>
                                </li>
                                <li class="flex items-center">
                                    <MapPinIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <span>{{ oferta.ubicacion }} ({{ oferta.modalidad }})</span>
                                </li>
                                <li class="flex items-center">
                                    <BriefcaseIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <span>{{ oferta.tipo_contrato }}</span>
                                </li>
                                <li class="flex items-center">
                                    <ClockIcon class="w-6 h-6 text-gray-500 mr-3" />
                                    <span>Experiencia: {{ oferta.experiencia_min }}+ años</span>
                                </li>
                            </ul>

                            <div class="mt-8 border-t pt-6">
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 text-lg">
                                    Aplicar ahora
                                </button>
                                <button class="w-full mt-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-lg flex items-center justify-center">
                                    <BookmarkIcon class="w-5 h-5 mr-2" />
                                    Guardar oferta
                                </button>
                            </div>

                             <div class="mt-6 text-sm text-gray-500">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold">Publicado:</span>
                                    <span>{{ formatDate(oferta.fecha_publicacion) }}</span>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="font-semibold">Cierra:</span>
                                    <span>{{ formatDate(oferta.fecha_cierre) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>