<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
});

const handleSubmit = () => {
    form.post('/teachers', {
        onSuccess: () => {
            form.reset();
        },
    });
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Create a Teacher',
                href: '/teachers/create',
            },
        ],
    },
});
</script>

<template>
    <Head title="Create a Teacher" />

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
                    placeholder="Enter Name"
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
            </div>

            <div class="space-y-2">
                <!-- Email Field -->
                <Label for="email" class="block text-sm font-medium text-gray-700">Email</Label>
                <Input
                    v-model="form.email"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter Email"
                />
                <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
            </div>

            <div class="space-y-2">
                <!-- Phone Field -->
                <Label for="phone" class="block text-sm font-medium text-gray-700">Phone</Label>
                <Input
                    v-model="form.phone"
                    type="text"
                    id="phone"
                    name="phone"
                    placeholder="Enter Phone"
                />
            </div>

            <div class="space-y-2">
                <!-- Address Field -->
                <Label for="address" class="block text-sm font-medium text-gray-700">Address</Label>
                <Input
                    v-model="form.address"
                    type="text"
                    id="address"
                    name="address"
                    placeholder="Enter Address"
                />
            </div>

            <!-- Submit Button -->
            <Button type="submit">
                Add Teacher
            </Button>
        </form>
    </div>
</template>
