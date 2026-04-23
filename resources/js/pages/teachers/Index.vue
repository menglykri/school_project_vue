<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { teachers } from '@/routes';
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

// alert success
const page = usePage()

// get teachers from props
const props = defineProps<{
    teachers: {
        id: number;
        name: string;
        email: string;
        phone: string;
        address: string;
    }[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Teachers',
                href: teachers(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Teachers" />

    <div class="p-4">
        <!-- Alert Message -->
        <AlertMessage />

        <!-- Create Teacher Button -->
        <Link class="flex justify-end items-center mb-4" href="/teachers/create">
            <Button>
                Create a Teacher
            </Button>
        </Link>

        <!-- table teachers -->
        <Table>
            <TableCaption>A list of your recent teachers.</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px]">
                        No
                    </TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Email</TableHead>
                    <TableHead>Phone</TableHead>
                    <TableHead>Address</TableHead>
                    <TableHead class="text-center">
                        Actions
                    </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="(teacher, index) in props.teachers" :key="teacher.id">
                    <TableCell class="font-medium px-2 py-4">
                        {{ index + 1 }}
                    </TableCell>
                    <TableCell>{{ teacher.name }}</TableCell>
                    <TableCell>{{ teacher.email }}</TableCell>
                    <TableCell>{{ teacher.phone }}</TableCell>
                    <TableCell>{{ teacher.address }}</TableCell>
                    <TableCell class="text-center">
                        <!-- edit -->
                        <Link :href="`/teachers/${teacher.id}/edit`" class="text-blue-500 hover:underline">
                            Edit
                        </Link>

                        <!-- delete -->
                        <Link
                            :href="`/teachers/${teacher.id}/delete`"
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
