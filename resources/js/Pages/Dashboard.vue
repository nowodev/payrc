<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
// import Select from '@/Components/Select.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const confirmingJobAddition = ref(false);

// const data = ref(["12", "13", "14"]);

const form = useForm({
    company_name: '',
    position: '',
    work_setting: '',
    job_type: '',
    pay_rate: '',
    pay_time: '',
});

const confirmJobAddition = () => {
    confirmingJobAddition.value = true;
};

const closeModal = () => {
    confirmingJobAddition.value = false;
    form.reset();
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 sm:p-6 lg:p-8">
                        <div class="sm:flex sm:items-center">
                            <div class="sm:flex-auto">
                                <h1 class="text-xl font-semibold text-gray-900">Jobs
                                </h1>
                                <p class="mt-2 text-sm text-gray-700">A list of all your
                                    jobs.</p>
                            </div>
                            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                                <SecondaryButton @click="confirmJobAddition">Add Job</SecondaryButton>
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
                                                        Company Name</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Position</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Work Setting</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Job Type</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Pay Rate</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                                        Pay Time</th>
                                                    <th scope="col"
                                                        class="relative py-3 pl-3 pr-4 sm:pr-6"> <span
                                                            class="sr-only">Edit</span> </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        <a>WCAY</a>
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        DSS</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        Onsite</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        Full-Time</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        $13</td>
                                                    <td
                                                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        Bi-Weekly</td>
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

            <Modal :show="confirmingJobAddition" @close="closeModal">
                <div class="p-6">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Create Job</h1>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 "> Add your teammate to your team and start
                        work to get things done </p>

                    <form class="mt-8 space-y-8">
                        <div class="grid grid-cols-2 gap-x-4">
                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="company_name"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Company Name" />


                                <TextInput id="company_name" type="text" v-model="form.company_name"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    placeholder="Apple" />

                                <InputError :message="form.errors.company_name" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">

                                <InputLabel for="position"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Position" />


                                <TextInput id="position" type="text" v-model="form.position"
                                    class="block w-full border-0 p-0 text-gray-900 placeholder-gray-500 focus:ring-0 sm:text-sm"
                                    placeholder="Software Developer" />

                                <InputError :message="form.errors.position" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div
                                class="relative rounded-md border border-gray-300 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="work_setting"
                                    class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Work Setting</label> <select id="work_setting" name="work_setting"
                                    class="block w-full border-0 rounded-md border-gray-300 py-2 pl-3 pr-10 focus:ring-0 sm:text-sm">
                                    <option>On-Site</option>
                                    <option>Remote</option>
                                    <option>Hybrid</option>
                                </select>

                            </div>

                            <!-- <Select :options="data" /> -->

                            <div
                                class="relative rounded-md border border-gray-300 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="job_type"
                                    class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Job Type</label> <select id="job_type" name="job_type"
                                    class="block w-full border-0 rounded-md border-gray-300 py-2 pl-3 pr-10 focus:ring-0 sm:text-sm">
                                    <option>Part-Time</option>
                                    <option selected>Full-Time</option>
                                    <option>Contract</option>
                                    <option>Internship</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-x-4">
                            <div class="relative rounded-md shadow-sm">

                                <InputLabel for="pay_rate"
                                    class="absolute -top-2 left-2 -mt-px inline-block bg-white px-1 text-xs font-medium text-gray-900"
                                    value="Pay Rate" />
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">$</span>
                                </div>

                                <TextInput id="pay_rate" type="text" v-model="form.pay_rate"
                                    class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="0.00" />

                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-gray-500 sm:text-sm" id="price-currency">/
                                        HR</span>
                                </div>

                                <InputError :message="form.errors.pay_rate" class="mt-2" />
                            </div>

                            <div
                                class="relative rounded-md border border-gray-300 shadow-sm focus-within:border-indigo-600 focus-within:ring-1 focus-within:ring-indigo-600">
                                <label for="pay_time"
                                    class="absolute -top-2 left-2 inline-block bg-white px-1 text-xs font-medium text-gray-900">
                                    Job Type</label> <select id="pay_time" name="pay_time"
                                    class="block w-full border-0 rounded-md border-gray-300 py-2 pl-3 pr-10 focus:ring-0 sm:text-sm">
                                    <option>Daily</option>
                                    <option>Weekly</option>
                                    <option>Bi-Weekly</option>
                                    <option selected>Monthly</option>
                                </select>
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
