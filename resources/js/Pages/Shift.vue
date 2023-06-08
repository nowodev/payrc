<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const confirmingShiftAddition = ref(false);


const form = useForm({
    name: '',
    start_time: '',
    end_time: '',
    has_break: '',
    break_type: '',
    break_duration: '',
    start_break: '',
    end_break: '',
    total_hours: '',
    expected_earnings: '',
});

const confirmShiftAddition = () => {
    confirmingShiftAddition.value = true;
};

const closeModal = () => {
    confirmingShiftAddition.value = false;
    form.reset();
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shifts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 lg:p-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-xl font-semibold text-gray-900">Shifts
                                </h1>
                                <p class="mt-2 text-sm text-gray-700">A list of all your
                                    shifts.</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <SecondaryButton @click="confirmShiftAddition">
                                    Add Shift
                                </SecondaryButton>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div
                                        class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                                        Name</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Start Time</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        End Time</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Break</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Break Type</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Start Break</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        End Break</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Total Hours</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Expected Earnings</th>
                                                    <th scope="col"
                                                        class="relative py-3 pl-3 pr-4 sm:pr-6"> <span
                                                            class="sr-only">Edit</span> </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        Morning</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        6:00 am</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        2:00 pm</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6 text-red-500">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>

                                                        <!-- Choose one -->

                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6 text-green-500">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                                        </svg>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        Paid</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        11:30 am</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        12:00 pm</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        8</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        $104</td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                        <a href="#"
                                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Modal :show="confirmingShiftAddition" @close="closeModal">
                <div class="p-6">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Create Shift</h1>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 "> Add your teammate to your team and start
                        work to get things done </p>

                    <form class="mt-8 space-y-8">
                        <div class="grid grid-cols-3 gap-x-4">
                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="name"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Name" />


                                <TextInput id="name" type="text" v-model="form.name"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    placeholder="Morning" />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="start_time"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Start Time" />


                                <TextInput id="start_time" type="time" v-model="form.start_time"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" />

                                <InputError :message="form.errors.start_time" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="end_time"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="End Time" />


                                <TextInput id="end_time" type="time" v-model="form.end_time"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" />

                                <InputError :message="form.errors.end_time" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-x-4 gap-y-8">
                            <div
                                class="relative rounded-md border border-gray-300 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="work_setting"
                                    class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Has Break</label>
                                <select id="work_setting" name="work_setting"
                                    class="block w-full border-0 rounded-md border-gray-300 py-2 pl-3 pr-10 focus:ring-0 sm:text-sm">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="break_type"
                                    class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Break Type</label>
                                <select id="break_type" name="break_type"
                                    class="block w-full border-0 rounded-md border-gray-300 py-2 pl-3 pr-10 focus:ring-0 sm:text-sm">
                                    <option>Paid</option>
                                    <option>Unpaid</option>
                                </select>
                            </div>

                            <!-- <Select :options="data" /> -->

                            <div class="relative rounded-md shadow-sm">
                                <InputLabel for="break_duration"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Break Duration" />

                                <TextInput id="break_duration" type="text" v-model="form.break_duration"
                                    class="block w-full rounded-md border-gray-300 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="30" />

                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm">MIN</span>
                                </div>

                                <InputError :message="form.errors.break_duration" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="start_break"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Start Break" />


                                <TextInput id="start_break" type="time" v-model="form.start_break"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" />

                                <InputError :message="form.errors.start_break" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="end_break"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="End Break" />


                                <TextInput id="end_break" type="time" v-model="form.end_break"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm" />

                                <InputError :message="form.errors.end_break" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="total_hours"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Total Hours" />


                                <TextInput id="total_hours" type="text" v-model="form.total_hours"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    readonly />

                                <InputError :message="form.errors.total_hours" class="mt-2" />
                            </div>
                        </div>
                    </form>

                    <div class="mt-6 flex justify-end">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                        <!-- <DangerButton class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="deleteUser"> Delete Account </DangerButton> -->
                    </div>
                </div>
            </Modal>
        </div>
    </AuthenticatedLayout>
</template>
