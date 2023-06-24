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
  job: Object,
  shifts: Object,
});

let shift_id = ref(0);

const confirmingShiftAddition = ref(false);

const confirmingShiftEdition = ref(false);

const confirmingShiftDeletion = ref(false);

const defaultData = {
  shift_name: "",
  start_time: "",
  end_time: "",
  has_break: "",
  break_type: "",
  break_duration: "",
  start_break: "",
  end_break: "",
  total_hours: "",
};

const form = useForm(defaultData);

const calculateHours = () => {
  if (form.has_break && form.break_type == "Unpaid") {
    // get total hours
    let hours = form.total_hours;

    // convert hours to minutes
    let minutes = hours * 60;

    // subtract break from total minutes
    let total_minutes = minutes - form.break_duration;

    // convert minutes back to hours
    return total_minutes / 60;
  }

  return form.total_hours;
};

const confirmShiftAddition = () => {
  confirmingShiftAddition.value = true;
};

const confirmShiftDeletion = (value) => {
  confirmingShiftDeletion.value = true;

  shift_id = value;
};

const confirmShiftEdition = (value) => {
  confirmingShiftEdition.value = true;

  shift_id = value;

  form.get(
    route("shift.index", {
      job: props.job,
      shift_id: value,
    }),
    {
      preserveScroll: true,
      preserveState: true,
      onSuccess: (res) => {
        const response = res.props.shift;

        form.shift_name = response.shift_name;
        form.start_time = response.start_time;
        form.end_time = response.end_time;
        form.has_break = response.has_break;
        form.break_type = response.break_type ?? "";
        form.break_duration = response.break_duration ?? "";
        form.start_break = response.start_break ?? "";
        form.end_break = response.end_break ?? "";
        form.total_hours = response.total_hours;
      },
    }
  );
};

const createShift = (value) => {
  form
    .transform((data) => ({
      ...data,
      // if break is unpaid, subtract breaktime from total hours
      expected_earnings: props.job.pay_rate * calculateHours(),
    }))
    .post(route("shift.store", value), {
      preserveScroll: true,
      onSuccess: () => closeModal(),
    });
};

const updateShift = (value) => {
  form
    .transform((data) => ({
      ...data,
      // if break is unpaid, subtract breaktime from total hours
      expected_earnings: props.job.pay_rate * calculateHours(),
    }))
    .put(
      route("shift.update", {
        job: props.job,
        shift: value,
      }),
      {
        preserveScroll: true,
        onSuccess: () => closeModal(),
      }
    );
};

const deleteShift = (value) => {
  form.delete(
    route("shift.destroy", {
      job: props.job,
      shift: value,
    }),
    {
      preserveScroll: true,
      onSuccess: () => closeModal(),
    }
  );
};

const closeModal = () => {
  confirmingShiftAddition.value = false;
  confirmingShiftEdition.value = false;
  confirmingShiftDeletion.value = false;

  form.defaults(defaultData);

  form.reset();
};
</script>

<template>
  <Head title="Shift" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shifts</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 lg:p-8">
          <div class="min-w-0 flex-1">
            <nav class="flex" aria-label="Breadcrumb">
              <ol role="list" class="flex items-center space-x-4">
                <li>
                  <div class="flex">
                    <Link
                      class="text-sm font-medium text-gray-500 hover:text-gray-700"
                      :href="route('jobs.index')"
                      >Jobs</Link
                    >
                  </div>
                </li>
                <li>
                  <div class="flex items-center">
                    <svg
                      class="h-5 w-5 flex-shrink-0 text-gray-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      aria-hidden="true"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                        clip-rule="evenodd"
                      />
                    </svg>
                    <p class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                      {{ job.company_name }}
                    </p>
                  </div>
                </li>
              </ol>
            </nav>
            <h2
              class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"
            >
              {{ job.position }}
            </h2>
            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
              <div class="mt-2 flex items-center text-sm text-gray-500">
                <svg
                  class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M6 3.75A2.75 2.75 0 018.75 1h2.5A2.75 2.75 0 0114 3.75v.443c.572.055 1.14.122 1.706.2C17.053 4.582 18 5.75 18 7.07v3.469c0 1.126-.694 2.191-1.83 2.54-1.952.599-4.024.921-6.17.921s-4.219-.322-6.17-.921C2.694 12.73 2 11.665 2 10.539V7.07c0-1.321.947-2.489 2.294-2.676A41.047 41.047 0 016 4.193V3.75zm6.5 0v.325a41.622 41.622 0 00-5 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25zM10 10a1 1 0 00-1 1v.01a1 1 0 001 1h.01a1 1 0 001-1V11a1 1 0 00-1-1H10z"
                    clip-rule="evenodd"
                  />
                  <path
                    d="M3 15.055v-.684c.126.053.255.1.39.142 2.092.642 4.313.987 6.61.987 2.297 0 4.518-.345 6.61-.987.135-.041.264-.089.39-.142v.684c0 1.347-.985 2.53-2.363 2.686a41.454 41.454 0 01-9.274 0C3.985 17.585 3 16.402 3 15.055z"
                  />
                </svg>
                {{ job.job_type }}
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500">
                <svg
                  class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    fill-rule="evenodd"
                    d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"
                    clip-rule="evenodd"
                  />
                </svg>
                {{ job.work_setting }}
              </div>
              <div class="mt-2 flex items-center text-sm text-gray-500">
                <svg
                  class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                >
                  <path
                    d="M10.75 10.818v2.614A3.13 3.13 0 0011.888 13c.482-.315.612-.648.612-.875 0-.227-.13-.56-.612-.875a3.13 3.13 0 00-1.138-.432zM8.33 8.62c.053.055.115.11.184.164.208.16.46.284.736.363V6.603a2.45 2.45 0 00-.35.13c-.14.065-.27.143-.386.233-.377.292-.514.627-.514.909 0 .184.058.39.202.592.037.051.08.102.128.152z"
                  />
                  <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-6a.75.75 0 01.75.75v.316a3.78 3.78 0 011.653.713c.426.33.744.74.925 1.2a.75.75 0 01-1.395.55 1.35 1.35 0 00-.447-.563 2.187 2.187 0 00-.736-.363V9.3c.698.093 1.383.32 1.959.696.787.514 1.29 1.27 1.29 2.13 0 .86-.504 1.616-1.29 2.13-.576.377-1.261.603-1.96.696v.299a.75.75 0 11-1.5 0v-.3c-.697-.092-1.382-.318-1.958-.695-.482-.315-.857-.717-1.078-1.188a.75.75 0 111.359-.636c.08.173.245.376.54.569.313.205.706.353 1.138.432v-2.748a3.782 3.782 0 01-1.653-.713C6.9 9.433 6.5 8.681 6.5 7.875c0-.805.4-1.558 1.097-2.096a3.78 3.78 0 011.653-.713V4.75A.75.75 0 0110 4z"
                    clip-rule="evenodd"
                  />
                </svg>
                {{ job.pay_rate }}/hr
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-4 sm:p-6 lg:p-8">
            <div class="sm:flex sm:items-center">
              <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Shifts</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all your shifts.</p>
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
                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                  >
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead class="bg-gray-50">
                        <tr>
                          <th
                            scope="col"
                            class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6"
                          >
                            Shift Name
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Start Time
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            End Time
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Break
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Break Type
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Start Break
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            End Break
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Total Hours
                          </th>
                          <th
                            scope="col"
                            class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500"
                          >
                            Expected Earnings
                          </th>
                          <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Edit</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-show="shifts" v-for="shift in shifts" :key="shift.id">
                          <td
                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                          >
                            {{ shift.shift_name }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ shift.start_time }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ shift.end_time }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <svg
                              v-if="shift.has_break"
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                              class="w-6 h-6 text-green-500"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                              />
                            </svg>

                            <svg
                              v-else
                              xmlns="http://www.w3.org/2000/svg"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke-width="1.5"
                              stroke="currentColor"
                              class="w-6 h-6 text-red-500"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                              />
                            </svg>
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ shift.break_type }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ shift.start_break }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ shift.end_break }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            {{ shift.total_hours }}
                          </td>
                          <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            ${{ shift.expected_earnings }}
                          </td>
                          <td
                            class="relative whitespace-nowrap space-x-3 flex items-center py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                          >
                            <SecondaryButton @click="confirmShiftEdition(shift.id)">
                              Edit
                            </SecondaryButton>

                            <DangerButton @click="confirmShiftDeletion(shift.id)">
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

                        <tr v-show="shifts == ''">
                          <td
                            colspan="10"
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

      <Modal
        :show="confirmingShiftAddition || confirmingShiftEdition"
        @close="closeModal"
      >
        <div class="p-6">
          <div class="flex items-center justify-between space-x-4">
            <h1 class="text-xl font-medium text-gray-800">Create Shift</h1>
          </div>

          <p class="mt-2 text-sm text-gray-500">
            Add your teammate to your team and start work to get things done
          </p>

          <form class="mt-8 space-y-8">
            <div class="grid grid-cols-3 gap-x-4">
              <div>
                <InputLabel for="shift_name" value="Shfit Name" />

                <TextInput
                  id="shift_name"
                  type="text"
                  v-model="form.shift_name"
                  class="block mt-1 w-full"
                  placeholder="Morning"
                />

                <InputError :message="form.errors.shift_name" class="mt-2" />
              </div>

              <div>
                <InputLabel for="start_time" value="Start Time" />

                <TextInput
                  id="start_time"
                  type="time"
                  v-model="form.start_time"
                  class="block mt-1 w-full"
                />

                <InputError :message="form.errors.start_time" class="mt-2" />
              </div>

              <div>
                <InputLabel for="end_time" value="End Time" />

                <TextInput
                  id="end_time"
                  type="time"
                  :min="form.start_time + '00:01'"
                  v-model="form.end_time"
                  class="block mt-1 w-full"
                />

                <InputError :message="form.errors.end_time" class="mt-2" />
              </div>
            </div>

            <div class="grid grid-cols-3 gap-x-4 gap-y-8">
              <div>
                <InputLabel for="has_break" value="Has Break" />
                <select
                  id="has_break"
                  v-model="form.has_break"
                  class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                >
                  <option></option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>

                <InputError :message="form.errors.has_break" class="mt-2" />
              </div>

              <div v-show="form.has_break == 1">
                <InputLabel for="break_type" value="Break Type" />
                <select
                  id="break_type"
                  v-model="form.break_type"
                  class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                >
                  <option></option>
                  <option>Paid</option>
                  <option>Unpaid</option>
                </select>

                <InputError :message="form.errors.break_type" class="mt-2" />
              </div>

              <div v-show="form.has_break == 1">
                <InputLabel for="break_duration" value="Break Duration" />

                <div class="relative mt-1 rounded-md shadow-sm">
                  <TextInput
                    id="break_duration"
                    type="number"
                    v-model="form.break_duration"
                    class="block mt-1 w-full"
                    placeholder="30"
                  />

                  <div
                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3"
                  >
                    <span class="text-gray-500 sm:text-sm">MIN</span>
                  </div>
                </div>

                <InputError :message="form.errors.break_duration" class="mt-2" />
              </div>

              <div v-show="form.has_break == 1">
                <InputLabel for="start_break" value="Start Break" />

                <TextInput
                  id="start_break"
                  type="time"
                  v-model="form.start_break"
                  class="block mt-1 w-full"
                />

                <InputError :message="form.errors.start_break" class="mt-2" />
              </div>

              <div v-show="form.has_break == 1">
                <InputLabel for="end_break" value="End Break" />

                <TextInput
                  id="end_break"
                  type="time"
                  v-model="form.end_break"
                  class="block mt-1 w-full"
                />

                <InputError :message="form.errors.end_break" class="mt-2" />
              </div>

              <div>
                <InputLabel for="total_hours" value="Total Hours" />

                <TextInput
                  id="total_hours"
                  type="number"
                  v-model="form.total_hours"
                  class="block mt-1 w-full"
                />

                <InputError :message="form.errors.total_hours" class="mt-2" />
              </div>
            </div>
          </form>

          <div class="flex items-center gap-4 justify-end mt-6">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

            <PrimaryButton
              v-if="confirmingShiftAddition"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="createShift(job.id)"
            >
              Save
            </PrimaryButton>

            <PrimaryButton
              v-else
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="updateShift(shift_id)"
            >
              Update
            </PrimaryButton>
          </div>
        </div>
      </Modal>

      <Modal :show="confirmingShiftDeletion" @close="closeModal">
        <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900">
            Are you sure you want to delete this shift?
          </h2>

          <p class="mt-1 text-sm text-gray-600">
            Once the shift is deleted, all of its resources and data will be permanently
            deleted.
          </p>

          <div class="mt-6 flex justify-end">
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>

            <DangerButton
              class="ml-3"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="deleteShift(shift_id)"
            >
              Delete Shift
            </DangerButton>
          </div>
        </div>
      </Modal>
    </div>
  </AuthenticatedLayout>
</template>
