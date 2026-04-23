<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    code: '',
});

const handleSubmit = () => {
    form.post('/subjects', {
        onSuccess: () => {
            form.reset();
        },
    });
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Create a Subject',
                href: '/subjects/create',
            },
        ],
    },
});
</script>

<template>
    <Head title="Create a Subject" />

    <div class="p-4">
        <form class="w-8/12 space-y-4" @submit.prevent="handleSubmit">
            <!-- Form fields for creating a teacher -->
            <div class="space-y-2">
                <!-- Name Field -->
                <Label for="name" class="block text-sm font-medium text-gray-700">Name</Label>
                <Input
                    v-model="form.name"
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter Subject name"
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
            </div>

            <div class="space-y-2">
                <!-- Code Field -->
                <Label for="code" class="block text-sm font-medium text-gray-700">Code</Label>
                <Input
                    v-model="form.code"
                    type="text"
                    id="code"
                    name="code"
                    placeholder="Enter Subject code"
                />
                <div v-if="form.errors.code" class="text-red-500 text-sm">{{ form.errors.code }}</div>
            </div>

            <!-- Submit Button -->
            <Button type="submit">
                Add Subject
            </Button>
        </form>
    </div>
</template>
