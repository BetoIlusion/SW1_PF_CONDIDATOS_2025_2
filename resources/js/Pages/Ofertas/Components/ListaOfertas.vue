<template>
    <div class="bg-gray-50 p-4 sm:p-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Ofertas de Trabajo Recientes</h3>
        <div class="space-y-4">
            <div v-if="ofertas.length === 0" class="text-center py-12">
                <p class="text-gray-500">No hay ofertas de trabajo disponibles en este momento.</p>
            </div>
            <div v-for="oferta in ofertas" :key="oferta.id"
                class="bg-white p-6 rounded-xl border border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all duration-300 cursor-pointer"
                @click="irAOferta(oferta.id)">

                <div class="flex flex-col sm:flex-row gap-6">
                    <!-- Icono/Logo -->
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                            <BuildingOffice2Icon class="w-8 h-8 text-gray-400" />
                        </div>
                    </div>

                    <!-- Detalles de la oferta -->
                    <div class="flex-1">
                        <h4 class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors">
                            {{ oferta.titulo }}
                        </h4>
                        
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mt-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                {{ oferta.modalidad }}
                            </span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                {{ oferta.tipo_contrato }}
                            </span>
                        </div>

                        <!-- Descripción Corta -->
                        <p class="text-gray-600 mt-3 text-sm line-clamp-2">
                            {{ oferta.descripcion }}
                        </p>
                    </div>
                </div>

                <!-- Footer de la tarjeta -->
                <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-sm text-gray-600">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center">
                            <MapPinIcon class="w-4 h-4 mr-1.5 text-gray-400" />
                            <span>{{ oferta.ubicacion || 'No especificado' }}</span>
                        </div>
                        <div class="flex items-center">
                            <CurrencyDollarIcon class="w-4 h-4 mr-1.5 text-gray-400" />
                            <span>{{ oferta.salario_minimo }} - {{ oferta.salario_maximo }} {{ oferta.moneda }}</span>
                        </div>
                    </div>
                    <div class="text-xs text-gray-500">
                        Publicado: {{ new Date(oferta.fecha_publicacion).toLocaleDateString() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { BuildingOffice2Icon, MapPinIcon, CurrencyDollarIcon } from '@heroicons/vue/24/outline';

interface Oferta {
    id: number
    titulo: string
    descripcion?: string
    modalidad?: string
    tipo_contrato?: string
    salario_minimo?: number
    salario_maximo?: number
    moneda?: string
    ubicacion?: string
    fecha_publicacion: string
}

const props = defineProps<{ ofertas: Oferta[] }>()

const irAOferta = (id: number) => {
    router.visit(route('ofertas.show', { id }))
}
</script>