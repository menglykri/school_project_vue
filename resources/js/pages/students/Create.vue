<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { Head, useForm } from '@inertiajs/vue3';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';

const form = useForm({
    first_name: '',
    last_name: '',
    sex: '',
    date_of_birth: '',
    phone: '',
    address: '',
    class_id: '',
});

const props = defineProps<{
    classes: {
        id: number;
        name: string;
    }[];
}>();

const handleSubmit = () => {
    form.transform((data) => ({
        ...data,
        class_id: data.class_id ? Number(data.class_id) : null,
    })).post('/students', {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Create a Student',
                href: '/students/create',
            },
        ],
    },
});
</script>

<template>
    <Head title="Create a Student" />

    <div class="p-4">
        <form class="w-8/12 space-y-4" @submit.prevent="handleSubmit">
            <!-- Form fields for creating a student -->
            <div class="space-y-2">
                <!-- First Name Field -->
                <Label for="first_name" class="block text-sm font-medium text-gray-700">First Name</Label>
                <Input
                    v-model="form.first_name"
                    type="text"
                    id="first_name"
                    name="first_name"
                    placeholder="Enter First Name"
                />
                <div v-if="form.errors.first_name" class="text-red-500 text-sm">{{ form.errors.first_name }}</div>
            </div>

            <div class="space-y-2">
                <!-- Last Name Field -->
                <Label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</Label>
                <Input
                    v-model="form.last_name"
                    type="text"
                    id="last_name"
                    name="last_name"
                    placeholder="Enter Last Name"
                />
                <div v-if="form.errors.last_name" class="text-red-500 text-sm">{{ form.errors.last_name }}</div>
            </div>

            <div class="space-y-2">
                <!-- Sex Field -->
                <Label for="sex" class="block text-sm font-medium text-gray-700">Sex</Label>
                <Input
                    v-model="form.sex"
                    type="text"
                    id="sex"
                    name="sex"
                    placeholder="Enter Sex"
                />
                <div v-if="form.errors.sex" class="text-red-500 text-sm">{{ form.errors.sex }}</div>
            </div>

            <div class="space-y-2">
                <!-- Date of Birth Field -->
                <Label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</Label>
                <Input
                    v-model="form.date_of_birth"
                    type="date"
                    id="date_of_birth"
                    name="date_of_birth"
                    placeholder="Enter Date of Birth"
                />
                <div v-if="form.errors.date_of_birth" class="text-red-500 text-sm">{{ form.errors.date_of_birth }}</div>
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
                <div v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</div>
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

            <!-- Selected Class Field -->
            <div class="space-y-2">
                <Label class="block text-sm font-medium text-gray-700">Class</Label>

                <Select v-model="form.class_id">
                    <SelectTrigger class="w-full">
                        <SelectValue placeholder="Select class"/>
                    </SelectTrigger>

                    <SelectContent>
                        <SelectItem
                            v-for="classItem in props.classes"
                            :key="classItem.id"
                            :value="String(classItem.id)"
                        >
                            {{ classItem.name }}
                        </SelectItem>
                    </SelectContent>
                </Select>

                <div v-if="form.errors.class_id" class="text-red-500 text-sm">
                    {{ form.errors.class_id }}
                </div>
            </div>

            <!-- Submit Button -->
            <Button type="submit">
                Add Student
            </Button>
        </form>
    </div>
</template>
