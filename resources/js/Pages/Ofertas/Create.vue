<script setup>
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['close']);

const form = useForm({
    titulo: '',
    descripcion: '',
    modalidad: 'Presencial',
    tipo_contrato: 'Tiempo completo',
    salario_minimo: null,
    salario_maximo: null,
    ubicacion: '',
    experiencia_min: 0,
    skills_requeridos: '',
});

const createOferta = () => {
    form.post(route('ofertas.store'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => {
            // Puedes manejar errores aquí si es necesario
        },
    });
};

const closeModal = () => {
    emit('close');
    form.reset();
    form.clearErrors();
};

// Resetea el formulario si el modal se cierra desde fuera
watch(() => props.show, (show) => {
    if (!show) {
        form.reset();
        form.clearErrors();
    }
});

</script>

<template>
    <Modal :show="show" @close="closeModal">
        <div class="p-6 bg-white dark:bg-gray-800">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Crear Nueva Oferta de Trabajo
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Completa los detalles de la nueva vacante.
            </p>

            <form @submit.prevent="createOferta" class="mt-6 space-y-6">
                <div>
                    <InputLabel for="titulo" value="Título de la Oferta" />
                    <TextInput id="titulo" v-model="form.titulo" type="text" class="mt-1 block w-full" required autofocus />
                    <InputError :message="form.errors.titulo" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="descripcion" value="Descripción" />
                    <textarea id="descripcion" v-model="form.descripcion" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4" required></textarea>
                    <InputError :message="form.errors.descripcion" class="mt-2" />
                </div>
                
                <div>
                    <InputLabel for="ubicacion" value="Ubicación" />
                    <TextInput id="ubicacion" v-model="form.ubicacion" type="text" class="mt-1 block w-full" required />
                    <InputError :message="form.errors.ubicacion" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="skills_requeridos" value="Habilidades Requeridas (separadas por comas)" />
                    <TextInput id="skills_requeridos" v-model="form.skills_requeridos" type="text" class="mt-1 block w-full" placeholder="Ej: PHP, Laravel, Vue.js" />
                    <InputError :message="form.errors.skills_requeridos" class="mt-2" />
                </div>

                <!-- Agrega aquí más campos del formulario según tu modelo OfertaTrabajo -->

                <div class="flex items-center justify-end mt-4">
                    <SecondaryButton @click="closeModal">
                        Cancelar
                    </SecondaryButton>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Crear Oferta
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>