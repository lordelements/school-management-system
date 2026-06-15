<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    username: '',
    first_name: '',
    middle_name: '',
    last_name: '',
    suffix: '',

    gender: '',
    birth_date: '',
    phone: '',
    address: '',

    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase title="Create an account" description="Enter your details below to create your account">

        <Head title="Register" />

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-2">
                <Label for="username">Username</Label>

                <Input id="username" type="text" required v-model="form.username" placeholder="Username" />

                <InputError :message="form.errors.username" />
            </div>

            <div class="grid gap-6">

                <!-- First Name -->
                <div class="grid gap-2">
                    <Label for="first_name">First Name</Label>

                    <Input id="first_name" type="text" required autofocus v-model="form.first_name"
                        placeholder="First Name" />

                    <InputError :message="form.errors.first_name" />
                </div>

                <!-- Middle Name -->
                <div class="grid gap-2">
                    <Label for="middle_name">Middle Name</Label>

                    <Input id="middle_name" type="text" v-model="form.middle_name" placeholder="Middle Name" />

                    <InputError :message="form.errors.middle_name" />
                </div>

                <!-- Last Name -->
                <div class="grid gap-2">
                    <Label for="last_name">Last Name</Label>

                    <Input id="last_name" type="text" required v-model="form.last_name" placeholder="Last Name" />

                    <InputError :message="form.errors.last_name" />
                </div>

                <!-- Suffix -->
                <div class="grid gap-2">
                    <Label for="suffix">Suffix</Label>

                    <Input id="suffix" type="text" v-model="form.suffix" placeholder="Jr., Sr., III" />

                    <InputError :message="form.errors.suffix" />
                </div>

                <!-- Email -->
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>

                    <Input id="email" type="email" required autocomplete="email" v-model="form.email"
                        placeholder="email@example.com" />

                    <InputError :message="form.errors.email" />
                </div>

                <!-- Password -->
                <div class="grid gap-2">
                    <Label for="password">Password</Label>

                    <Input id="password" type="password" required autocomplete="new-password" v-model="form.password"
                        placeholder="Password" />

                    <InputError :message="form.errors.password" />
                </div>

                <!-- Confirm Password -->
                <div class="grid gap-2">
                    <Label for="password_confirmation">
                        Confirm Password
                    </Label>

                    <Input id="password_confirmation" type="password" required autocomplete="new-password"
                        v-model="form.password_confirmation" placeholder="Confirm Password" />

                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <!-- Gender -->
                <div class="grid gap-2">
                    <Label for="gender">Gender</Label>

                    <select id="gender" v-model="form.gender"
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>

                    <InputError :message="form.errors.gender" />
                </div>

                <!-- Birth Date -->
                <div class="grid gap-2">
                    <Label for="birth_date">Birth Date</Label>

                    <Input id="birth_date" type="date" v-model="form.birth_date" />

                    <InputError :message="form.errors.birth_date" />
                </div>

                <!-- Phone -->
                <div class="grid gap-2">
                    <Label for="phone">Phone Number</Label>

                    <Input id="phone" type="text" v-model="form.phone" placeholder="+63 912 345 6789" />

                    <InputError :message="form.errors.phone" />
                </div>

                <!-- Address -->
                <div class="grid gap-2">
                    <Label for="address">Address</Label>

                    <textarea id="address" v-model="form.address" rows="3"
                        class="w-full rounded-md border border-input px-3 py-2"
                        placeholder="Complete Address"></textarea>

                    <InputError :message="form.errors.address" />
                </div>

                <Button type="submit" class="mt-2 w-full" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />

                    Create account
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?

                <TextLink :href="route('login')" class="underline underline-offset-4">
                    Log in
                </TextLink>
            </div>
        </form>
    </AuthBase>
</template>