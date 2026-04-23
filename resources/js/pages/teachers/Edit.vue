<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Head, useForm } from '@inertiajs/vue3';

// get teachers from props
const props = defineProps<{
    teacher: {
        id: number;
        name: string;
        email: string;
        phone: string;
        address: string;
    }[];
}>();

// initialize form with existing teacher data
const form = useForm({
    name: props.teacher.name || '',
    email: props.teacher.email || '',
    phone: props.teacher.phone || '',
    address: props.teacher.address || '',
});

const handleSubmit = () => {
    form.put(`/teachers/${props.teacher.id}`, {
        onSuccess: () => {
            form.reset();
        },
    });
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Edit a Teacher',
                href: '/teachers/edit',
            },
        ],
    },
});
</script>

<template>
    <Head title="Edit a Teacher" />

    <div class="p-4">
        <form class="w-8/12 space-y-4" @submit.prevent="handleSubmit">
            <!-- Form fields for creating a teacher -->
            <div class="space-y-2">
                <!-- Name Field -->
                <Label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Name</Label
                >
                <Input
                    v-model="form.name"
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Update Name"
                />
                <div v-if="form.errors.name" class="text-sm text-red-500">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="space-y-2">
                <!-- Email Field -->
                <Label
                    for="email"
                    class="block text-sm font-medium text-gray-700"
                    >Email</Label
                >
                <Input
                    v-model="form.email"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Update Email"
                />
                <div v-if="form.errors.email" class="text-sm text-red-500">
                    {{ form.errors.email }}
                </div>
            </div>

            <div class="space-y-2">
                <!-- Phone Field -->
                <Label
                    for="phone"
                    class="block text-sm font-medium text-gray-700"
                    >Phone</Label
                >
                <Input
                    v-model="form.phone"
                    type="text"
                    id="phone"
                    name="phone"
                    placeholder="Update Phone"
                />
            </div>

            <div class="space-y-2">
                <!-- Address Field -->
                <Label
                    for="address"
                    class="block text-sm font-medium text-gray-700"
                    >Address</Label
                >
                <Input
                    v-model="form.address"
                    type="text"
                    id="address"
                    name="address"
                    placeholder="Update Address"
                />
            </div>

            <!-- Submit Button -->
            <Button type="submit"> Update Teacher </Button>
        </form>
    </div>
</template>
