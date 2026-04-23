<script setup lang="ts">
import { Head, Link} from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';
import { usePage } from '@inertiajs/vue3';
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

// alert success
const page = usePage()

// get classes from props
const props = defineProps<{
    classes: {
        id: number;
        name: string;
        room_number: string;
    }[];
}>();

// confirm delete
const confirmDelete = (e) => {
    if (!confirm('Are you sure?')) {
        e.preventDefault()
    }
}

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Classes',
                href: '/classes',
            },
        ],
    },
});
</script>

<template>
    <Head title="Classes" />

    <div class="p-4">
        <!-- Alert Message -->
        <AlertMessage />

        <!-- Create Teacher Button -->
        <Link class="flex justify-end items-center mb-4" href="/classes/create">
            <Button>
                Create a Class
            </Button>
        </Link>

        <!-- Classes Table -->
        <Table>
            <TableCaption>A list of your classes.</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px]">ID</TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Room Number</TableHead>
                    <TableHead class="text-center">Actions</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="(classItem, index) in props.classes" :key="classItem.id">
                    <TableCell class="font-medium px-2 py-4">{{ index + 1 }}</TableCell>
                    <TableCell>{{ classItem.name }}</TableCell>
                    <TableCell>{{ classItem.room_number }}</TableCell>
                    <TableCell class="text-center">
                        <!-- Edit Link -->
                        <Link :href="`/classes/${classItem.id}/edit`" class="text-blue-500 hover:underline">Edit</Link>

                        <!-- Delete Link -->
                        <Link
                            :href="`/classes/${classItem.id}/delete`"
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