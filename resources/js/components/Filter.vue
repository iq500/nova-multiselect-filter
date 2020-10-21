<template>
  <div>
    <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

    <div class="p-2">
      <v-select
          appendToBody
          :value="values"
          :options="this.filter.options"
          :placeholder="placeholder"
          :multiple="true"
          :class="{
              'v-select--not-empty': this.values.length,
          }"
          class="multiselect-filter"
          label="name"
          track-by="value"
          @input="handleChange"
      >
        <div slot="no-options">{{noOptionsLabel}}</div>
      </v-select>

    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select';
export default {
  components: {vSelect},
  props: {
    resourceName: {
      type: String,
      required: true,
    },
    filterKey: {
      type: String,
      required: true,
    },
  },

  methods: {
    handleChange: function (options) {
      this.$store.commit(`${this.resourceName}/updateFilterState`, {
        filterClass: this.filterKey,
        value: options.map((option) => option.value),
      });
      this.$emit('change');
    },
  },
  computed: {
    filter: function () {
      return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
    },
    noOptionsLabel: function () {
      return this.filter.noOptionsLabel || this.__('Sorry, no matching options.');
    },
    placeholder: function () {
      return this.filter.placeholder || this.__('Select option');
    },
    values: function () {
      if (this.filter.currentValue === undefined || this.filter.currentValue === '') {
        return [];
      }
      return this.filter.options.filter(option => {
        return this.filter.currentValue.indexOf(option.value) !== -1;
      });
    }
  },
};
</script>
