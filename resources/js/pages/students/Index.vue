<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { students } from '@/routes';
import Button from '@/components/ui/button/Button.vue';
import AlertMessage from '@/components/AlertMessage.vue';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableFooter,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';

// confirm delete
const confirmDelete = (e) => {
    if (!confirm('Are you sure?')) {
        e.preventDefault()
    }
}

// get students from props
const props = defineProps<{
    students: {
        id: number;
        first_name: string;
        last_name: string;
        sex: string;
        date_of_birth: string;
        phone: string;
        address: string;
        class: {
            id: number;
            name: string;
        };
    }[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Students',
                href: students(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Students" />

    <div class="p-4">
        <!-- Alert Message -->
        <AlertMessage />

        <!-- Create Student Button -->
        <Link class="flex justify-end items-center mb-4" href="/students/create">
            <Button>
                Create a Student
            </Button>
        </Link>

        <!-- Students Table -->
        <Table>
            <TableCaption>A list of students</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px]">ID</TableHead>
                    <TableHead>First Name</TableHead>
                    <TableHead>Last Name</TableHead>
                    <TableHead>Sex</TableHead>
                    <TableHead>Date of Birth</TableHead>
                    <TableHead>Phone</TableHead>
                    <TableHead>Address</TableHead>
                    <TableHead>Class</TableHead>
                    <TableHead class="text-center">Actions</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="(student, index) in props.students" :key="student.id">
                    <TableCell class="font-medium">{{ index + 1 }}</TableCell>
                    <TableCell>{{ student.first_name }}</TableCell>
                    <TableCell>{{ student.last_name }}</TableCell>
                    <TableCell>{{ student.sex }}</TableCell>
                    <TableCell>{{ student.date_of_birth }}</TableCell>
                    <TableCell>{{ student.phone }}</TableCell>
                    <TableCell>{{ student.address }}</TableCell>
                    <TableCell>{{ student.class.name }}</TableCell>
                    <TableCell class="text-center">
                        <!-- Edit Link -->
                        <Link :href="`/students/${student.id}/edit`" class="text-blue-500 hover:underline">
                            Edit
                        </Link>
                        
                        <!-- Delete Link -->
                        <Link
                            :href="`/students/${student.id}/delete`"
                            method="delete"
                            as="button"
                            class="text-red-500 hover:underline ml-4"
                            @click="confirmDelete"
                        >
                            Delete
                        </Link>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
