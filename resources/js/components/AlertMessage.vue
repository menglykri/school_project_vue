<script setup lang="ts">
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { usePage } from '@inertiajs/vue3';
import { MailCheck } from 'lucide-vue-next';

// alert success
const page = usePage();

</script>

<template>
    <div v-if="page.props.flash?.message" class="alert mb-4">
        <Alert class="bg-green-200">
            <MailCheck class="h-4 w-4" />
            <AlertTitle>Success!</AlertTitle>
            <AlertDescription>
                {{ page.props.flash.message }}
            </AlertDescription>
        </Alert>
    </div>
</template>