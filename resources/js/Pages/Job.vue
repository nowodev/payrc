<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const confirmingJobAddition = ref(false);

const form = useForm({
	company_name: "",
	position: "",
	work_setting: "",
	job_type: "",
	pay_rate: "",
	pay_time: "",
});

const confirmJobAddition = () => {
	confirmingJobAddition.value = true;
};

const createJob = () => {
	form.post(route("jobs.store"), {
		preserveScroll: true,
		onSuccess: () => closeModal(),
	});
};

const closeModal = () => {
	confirmingJobAddition.value = false;

	form.reset();
};

defineProps({
	jobs: {
		type: Object,
	},
});
</script>

<template>
	<Head title="Job" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Jobs
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-4 sm:p-6 lg:p-8">
						<div class="sm:flex sm:items-center">
							<div class="sm:flex-auto">
								<h1 class="text-xl font-semibold text-gray-900">
									Jobs
								</h1>
								<p class="mt-2 text-sm text-gray-700">
									A list of all your jobs.
								</p>
							</div>
							<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
								<SecondaryButton @click="confirmJobAddition"
									>Add Job</SecondaryButton
								>
							</div>
						</div>

						<div class="mt-8 flex flex-col">
							<div
								class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
							>
								<div
									class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
								>
									<div
										class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
									>
										<table
											class="min-w-full divide-y divide-gray-300"
										>
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
													<th
														scope="col"
														class="relative py-3 pl-3 pr-4 sm:pr-6"
													>
														<span class="sr-only"
															>Edit</span
														>
													</th>
												</tr>
											</thead>
											<tbody
												class="divide-y divide-gray-200 bg-white"
											>
												<tr
													v-for="job in jobs"
													:key="job.id"
												>
													<td
														class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
													>
														{{ job.company_name }}
													</td>
													<td
														class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
													>
														{{ job.position }}
													</td>
													<td
														class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
													>
														{{ job.work_setting }}
													</td>
													<td
														class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
													>
														{{ job.job_type }}
													</td>
													<td
														class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
													>
														{{ job.pay_rate }}
													</td>
													<td
														class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
													>
														{{ job.pay_time }}
													</td>
													<td
														class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
													>
														<a
															href="#"
															class="text-indigo-600 hover:text-indigo-900"
															>Edit</a
														>
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
						<h1 class="text-xl font-medium text-gray-800">
							Create Job
						</h1>
					</div>

					<p class="mt-2 text-sm text-gray-500">
						Add your teammate to your team and start work to get
						things done
					</p>

					<form class="mt-6 space-y-6">
						<div class="grid grid-cols-2 gap-x-4">
							<div>
								<InputLabel
									for="company_name"
									value="Company Name"
								/>

								<TextInput
									id="company_name"
									type="text"
									v-model="form.company_name"
									class="block mt-1 w-full"
									placeholder="Apple"
								/>

								<InputError
									:message="form.errors.company_name"
									class="mt-2"
								/>
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

								<InputError
									:message="form.errors.position"
									class="mt-2"
								/>
							</div>
						</div>

						<div class="grid grid-cols-2 gap-x-4">
							<div>
								<InputLabel
									for="work_setting"
									value="Work Setting"
								/>

								<select
									id="work_setting"
									v-model="form.work_setting"
									class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
								>
									<option>On-Site</option>
									<option>Remote</option>
									<option>Hybrid</option>
								</select>

								<InputError
									:message="form.errors.work_setting"
									class="mt-2"
								/>
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

								<InputError
									:message="form.errors.job_type"
									class="mt-2"
								/>
							</div>
						</div>

						<div class="grid grid-cols-2 gap-x-4">
							<div>
								<InputLabel for="pay_rate" value="Pay Rate" />

								<div class="relative mt-1 rounded-md shadow-sm">
									<div
										class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
									>
										<span class="text-gray-500 sm:text-sm"
											>$</span
										>
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
										<span class="text-gray-500 sm:text-sm"
											>/ HR</span
										>
									</div>
								</div>

								<InputError
									:message="form.errors.pay_rate"
									class="mt-2"
								/>
							</div>

							<div>
								<InputLabel for="pay_time" value="Pay Time" />

								<select
									id="pay_time"
									v-model="form.pay_time"
									class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
								>
									<option>Daily</option>
									<option>Weekly</option>
									<option>Bi-Weekly</option>
									<option selected>Monthly</option>
								</select>

								<InputError
									:message="form.errors.pay_time"
									class="mt-2"
								/>
							</div>
						</div>
					</form>

					<div class="flex items-center gap-4 justify-end mt-6">
						<SecondaryButton @click="closeModal"
							>Cancel</SecondaryButton
						>

						<PrimaryButton
							:class="{ 'opacity-25': form.processing }"
							:disabled="form.processing"
							@click="createJob"
						>
							Save
						</PrimaryButton>

						<Transition
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
						</Transition>
					</div>
				</div>
			</Modal>
		</div>
	</AuthenticatedLayout>
</template>
