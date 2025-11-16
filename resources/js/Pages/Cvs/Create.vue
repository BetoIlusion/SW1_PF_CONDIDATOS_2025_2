<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    // Puedes pasar un CV aquí para modo edición en el futuro
});

const emit = defineEmits(['close']);

const form = useForm({
    experiencia_total: '',
    idiomas: '',
    skills: [],
    educacion: [{ institucion: '', carrera: '' }],
    pretension_salarial: '',
    disponibilidad: '',
    portafolio_url: '',
});

// --- Manejo de Skills ---
const skillInput = ref('');
const addSkill = () => {
    if (skillInput.value.trim() !== '' && !form.skills.includes(skillInput.value.trim())) {
        form.skills.push(skillInput.value.trim());
        skillInput.value = '';
    }
};
const removeSkill = (index) => {
    form.skills.splice(index, 1);
};

// --- Manejo de Educación ---
const addEducation = () => {
    form.educacion.push({ institucion: '', carrera: '' });
};
const removeEducation = (index) => {
    form.educacion.splice(index, 1);
};

const submit = () => {
    form.post(route('curriculums.store'), {
        onSuccess: () => {
            form.reset();
            emit('close');
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <!-- Experiencia Total -->
            <div>
                <InputLabel for="experiencia_total" value="Años de Experiencia Total" />
                <TextInput id="experiencia_total" v-model="form.experiencia_total" type="number" class="mt-1 block w-full" />
                <InputError :message="form.errors.experiencia_total" class="mt-2" />
            </div>

            <!-- Pretensión Salarial -->
            <div>
                <InputLabel for="pretension_salarial" value="Pretensión Salarial (MXN)" />
                <TextInput id="pretension_salarial" v-model="form.pretension_salarial" type="number" step="1000" class="mt-1 block w-full" />
                <InputError :message="form.errors.pretension_salarial" class="mt-2" />
            </div>

            <!-- Disponibilidad -->
            <div class="md:col-span-2">
                <InputLabel for="disponibilidad" value="Disponibilidad (e.g., Tiempo completo, Inmediata)" />
                <TextInput id="disponibilidad" v-model="form.disponibilidad" type="text" class="mt-1 block w-full" />
                <InputError :message="form.errors.disponibilidad" class="mt-2" />
            </div>
            
            <!-- Portafolio URL -->
            <div class="md:col-span-2">
                <InputLabel for="portafolio_url" value="URL del Portafolio" />
                <TextInput id="portafolio_url" v-model="form.portafolio_url" type="url" class="mt-1 block w-full" />
                <InputError :message="form.errors.portafolio_url" class="mt-2" />
            </div>

            <!-- Skills -->
            <div class="md:col-span-2">
                <InputLabel value="Habilidades (Skills)" />
                <div class="flex items-center mt-1">
                    <TextInput v-model="skillInput" @keydown.enter.prevent="addSkill" type="text" class="flex-grow" placeholder="Escribe una habilidad y presiona Enter" />
                    <PrimaryButton type="button" @click="addSkill" class="ml-2">Añadir</PrimaryButton>
                </div>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span v-for="(skill, index) in form.skills" :key="index" class="flex items-center px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                        {{ skill }}
                        <button @click="removeSkill(index)" class="ml-2 text-indigo-600 hover:text-indigo-900">&times;</button>
                    </span>
                </div>
                <InputError :message="form.errors.skills" class="mt-2" />
            </div>

            <!-- Educación -->
            <div class="md:col-span-2 space-y-4">
                <InputLabel value="Educación" />
                <div v-for="(edu, index) in form.educacion" :key="index" class="flex items-start gap-2 p-2 border rounded-lg">
                    <div class="flex-grow">
                        <TextInput v-model="edu.institucion" type="text" class="mt-1 block w-full" placeholder="Institución" />
                        <TextInput v-model="edu.carrera" type="text" class="mt-2 block w-full" placeholder="Carrera / Título" />
                    </div>
                    <SecondaryButton type="button" @click="removeEducation(index)" class="mt-1 !px-3 !py-2 text-red-500">&times;</SecondaryButton>
                </div>
                <PrimaryButton type="button" @click="addEducation">Añadir Educación</PrimaryButton>
                <InputError :message="form.errors.educacion" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 p-6 bg-gray-50 border-t">
            <SecondaryButton @click="$emit('close')">Cancelar</SecondaryButton>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Guardar Currículum
            </PrimaryButton>
        </div>
    </form>
</template>