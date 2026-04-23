<script setup lang="ts">
import { Head, Link} from '@inertiajs/vue3';
import { subjects } from '@/routes';
import Button from '@/components/ui/button/Button.vue';
import { usePage } from '@inertiajs/vue3';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { MailCheck } from "lucide-vue-next";
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
        <div v-if="page.props.flash?.message" class="alert mb-4">
            <Alert class="bg-green-200">
                <MailCheck class="h-4 w-4" />
                <AlertTitle>Success!</AlertTitle>
                <AlertDescription>
                    {{ page.props.flash.message }}
                </AlertDescription>
            </Alert>
        </div>

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
                        <Link :href="`/classes/${classItem.id}/edit`" class="text-blue-500 hover:underline">Edit</Link>
                        <Link :href="`/classes/${classItem.id}`" @click.prevent="confirmDelete" class="text-red-500 hover:underline ml-2">Delete</Link>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>