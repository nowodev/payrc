<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
  jobs: Object,
});

let job_id = ref(0);

const confirmingJobAddition = ref(false);

const confirmingJobEdition = ref(false);

const confirmingJobDeletion = ref(false);

const defaultData = {
  company_name: "",
  position: "",
  work_setting: "",
  job_type: "",
  pay_rate: "",
  pay_time: "",
};

const form = useForm(defaultData);

const confirmJobAddition = () => {
  confirmingJobAddition.value = true;
};

const confirmJobDeletion = (value) => {
  confirmingJobDeletion.value = true;

  job_id = value;
};

const confirmJobEdition = (value) => {
  confirmingJobEdition.value = true;

  job_id = value;

  form.get(route("jobs.index", { job_id: value }), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: (res) => {
      const response = res.props.job;

      form.company_name = response.company_name;
      form.position = response.position;
      form.work_setting = response.work_setting;
      form.job_type = response.job_type;
      form.pay_rate = response.pay_rate;
      form.pay_time = response.pay_time;
    },
  });
};

const createJob = () => {
  form.post(route("jobs.store"), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
  });
};

const updateJob = (value) => {
  form.put(route("jobs.update", value), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
  });
};

const deleteJob = (value) => {
  form.delete(route("jobs.destroy", value), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
  });
};

const closeModal = () => {
  confirmingJobAddition.value = false;
  confirmingJobEdition.value = false;
  confirmingJobDeletion.value = false;

  form.defaults(defaultData);

  form.reset();
};
</script>

<template>
  <Head title="Job" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jobs</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-4 sm:p-6 lg:p-8">
            <div class="sm:flex sm:items-center">
              <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Jobs</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all your jobs.</p>
              </div>
              <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <SecondaryButton @click="confirmJobAddition"> Add Job </SecondaryButton>
              </div>
            </div>

            <div class="mt-8 flex flex-col">
              <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                  <div
                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                  >
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6"
                          >
                            Company Name
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Position
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Work Setting
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Job Type
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Pay Rate
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Pay Time
                          </th>
                          <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Edit</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-show="jobs" v-for="job in jobs" :key="job.id">
                          <td
                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                          >
                            <Link :href="route('shift.index', job.id)">{{
                              job.company_name
                            }}</Link>
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ job.position }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ job.work_setting }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ job.job_type }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ job.pay_rate }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ job.pay_time }}
                          </td>
                          <td
                            class="relative whitespace-nowrap space-x-3 flex items-center py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                          >
                            <SecondaryButton @click="confirmJobEdition(job.id)">
                              Edit
                            </SecondaryButton>

                            <DangerButton @click="confirmJobDeletion(job.id)">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-4 h-4"
                              >
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                />
                              </svg>
                            </DangerButton>
                          </td>
                        </tr>

                        <tr v-show="jobs == ''">
                          <td
                            colspan="7"
                            class="whitespace-nowrap w-full text-center px-3 py-4 text-sm text-gray-500"
                          >
                            No Record
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

      <Modal :show="confirmingJobAddition || confirmingJobEdition" @close="closeModal">
        <div class="p-6">
          <div class="flex items-center justify-between space-x-4">
            <h1 class="text-xl font-medium text-gray-800">Create Job</h1>
          </div>

          <p class="mt-2 text-sm text-gray-500">
            Add your teammate to your team and start work to get things done
          </p>

          <form class="mt-6 space-y-6">
            <div class="grid grid-cols-2 gap-x-4">
              <div>
                <InputLabel for="company_name" value="Company Name" />

                <TextInput
                  id="company_name"
                  type="text"
                  v-model="form.company_name"
                  class="block mt-1 w-full"
                  placeholder="Apple"
                />

                <InputError :message="form.errors.company_name" class="mt-2" />
              </div>

              <div>
                <InputLabel for="position" value="Position" />

                <TextInput
                  id="position"
                  type="text"
                  v-model="form.position"
                  class="block mt-1 w-full"
                  placeholder="Software Developer"
                />

                <InputError :message="form.errors.position" class="mt-2" />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4">
              <div>
                <InputLabel for="work_setting" value="Work Setting" />

                <select
                  id="work_setting"
                  v-model="form.work_setting"
                  class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                >
                  <option>On-Site</option>
                  <option>Remote</option>
                  <option>Hybrid</option>
                </select>

                <InputError :message="form.errors.work_setting" class="mt-2" />
              </div>

              <div>
                <InputLabel for="job_type" value="Job Type" />

                <select
                  id="job_type"
                  v-model="form.job_type"
                  class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                >
                  <option>Part-Time</option>
                  <option selected>Full-Time</option>
                  <option>Contract</option>
                  <option>Internship</option>
                </select>

                <InputError :message="form.errors.job_type" class="mt-2" />
              </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4">
              <div>
                <InputLabel for="pay_rate" value="Pay Rate" />

                <div class="relative mt-1 rounded-md shadow-sm">
                  <div
                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                  >
                    <span class="text-gray-500 sm:text-sm">$</span>
                  </div>

                  <TextInput
                    id="pay_rate"
                    type="number"
                    step="0.01"
                    v-model="form.pay_rate"
                    class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="0.00"
                  />

                  <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                  >
                    <span class="text-gray-500 sm:text-sm">/ HR</span>
                  </div>
                </div>

                <InputError :message="form.errors.pay_rate" class="mt-2" />
              </div>

              <div>
                <InputLabel for="pay_time" value="Pay Time" />

                <select
                  id="pay_time"
                  v-model="form.pay_time"
                  class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                >
                  <option></option>
                  <option>Daily</option>
                  <option>Weekly</option>
                  <option>Bi-Weekly</option>
                  <option selected>Monthly</option>
                </select>

                <InputError :message="form.errors.pay_time" class="mt-2" />
              </div>
            </div>
          </form>

          <div class="flex items-center gap-4 justify-end mt-6">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

            <PrimaryButton
              v-if="confirmingJobAddition"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="createJob"
            >
              Save
            </PrimaryButton>

            <PrimaryButton
              v-else
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="updateJob(job_id)"
            >
              Update
            </PrimaryButton>

            <!-- <Transition
                    							enter-from-class="opacity-0"
                    							leave-to-class="opacity-0"
                    							class="transition ease-in-out"
                    						>
                    							<p
                    								v-if="form.recentlySuccessful"
                    								class="text-sm text-gray-600"
                    							>
                    								Saved.
                    							</p>
                    						</Transition> -->
          </div>
        </div>
      </Modal>

      <Modal :show="confirmingJobDeletion" @close="closeModal">
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">
            Are you sure you want to delete this job?
          </h2>

          <p class="mt-1 text-sm text-gray-600">
            Once the job is deleted, all of its resources and data will be permanently
            deleted.
          </p>

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

            <DangerButton
              class="ml-3"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="deleteJob(job_id)"
            >
              Delete Job
            </DangerButton>
          </div>
        </div>
      </Modal>
    </div>
  </AuthenticatedLayout>
</template>
