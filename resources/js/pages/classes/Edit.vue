<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Head, useForm } from '@inertiajs/vue3';

// get teachers from props
const props = defineProps<{
    classItem: {
        id: number;
        name: string;
        room_number: string;
    };
}>();

// initialize form with existing teacher data
const form = useForm({
    name: props.classItem.name,
    room_number: props.classItem.room_number,
});

const handleSubmit = () => {
    form.put(`/classes/${props.classItem.id}`, {
        onSuccess: () => {
            form.reset();
        },
    });
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Edit Class',
                href: '/classes/edit',
            },
        ],
    },
});
</script>

<template>
    <Head title="Edit a Class" />

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
                    placeholder="Update Class name"
                />
                <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
            </div>

            <div class="space-y-2">
                <!-- Room Number Field -->
                <Label for="room_number" class="block text-sm font-medium text-gray-700">Room Number</Label>
                <Input
                    v-model="form.room_number"
                    type="text"
                    id="room_number"
                    name="room_number"
                    placeholder="Update Room number"
                />
                <div v-if="form.errors.room_number" class="text-red-500 text-sm">{{ form.errors.room_number }}</div>
            </div>

            <!-- Submit Button -->
            <Button type="submit">
                Update Class
            </Button>
        </form>
    </div>
</template>
