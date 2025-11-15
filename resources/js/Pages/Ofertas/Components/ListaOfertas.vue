<template>
    <div class="p-4">
        <h3 class="text-lg font-bold mb-4">Ofertas de Trabajo</h3>
        <ul>
            <li v-for="oferta in ofertas" :key="oferta.id" class="mb-2 border-b py-2">
                <div class="block hover:underline cursor-pointer" @click="irAOferta(oferta.id)">
                    <h4 class="font-semibold">{{ oferta.titulo }}</h4>
                    <p>{{ oferta.descripcion }}</p>
                </div>
                <p class="text-sm text-gray-500">Modalidad: {{ oferta.modalidad }} | Contrato: {{ oferta.tipo_contrato }}</p>
                <p class="text-sm text-gray-500">Salario: {{ oferta.salario_minimo }} - {{ oferta.salario_maximo }} {{ oferta.moneda }}</p>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import route from 'ziggy-js'

interface Oferta {
    id: number
    titulo: string
    descripcion?: string
    modalidad?: string
    tipo_contrato?: string
    salario_minimo?: number
    salario_maximo?: number
    moneda?: string
}

const props = defineProps<{ ofertas: Oferta[] }>()

const irAOferta = (id: number) => {
    router.visit(route('ofertas.show', { id }))
}
</script>