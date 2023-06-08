<script>
export default {
    name: 'DynamicSelect',
    props: {
        options: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            selectedOption: null,
        };
    },
    methods: {
        selectOption(option) {
            this.selectedOption = option;
        },
    },
};
</script>

<template>
    <select :options="options" :selected-option="selectedOption" @change="selectOption">
        <option v-for="option in options" :key="option.value" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
