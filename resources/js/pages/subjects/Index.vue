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

// get subjects from props
const props = defineProps<{
    subjects: {
        id: number;
        name: string;
        code: string;
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
                title: 'Subjects',
                href: subjects(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Subjects" />

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
        <Link class="flex justify-end items-center mb-4" href="/subjects/create">
            <Button>
                Create a Subject
            </Button>
        </Link>

        <!-- Subjects Table -->
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px]">No</TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Code</TableHead>
                    <TableHead class="text-center">Actions</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <!-- Table rows will be populated dynamically -->
                <TableRow v-for="(subject, index) in page.props.subjects" :key="subject.id">
                    <TableCell class="font-medium px-2 py-3">{{ index + 1 }}</TableCell>
                    <TableCell>{{ subject.name }}</TableCell>
                    <TableCell>{{ subject.code }}</TableCell>
                    <TableCell class="text-center">
                        <!-- edit -->
                        <Link :href="`/subjects/${subject.id}/edit`" class="text-blue-500 hover:underline">
                            Edit
                        </Link>

                        <!-- delete -->
                        <Link
                            :href="`/subjects/${subject.id}/delete`"
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