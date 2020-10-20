<template>
  <div>
    <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">{{ filter.name }}</h3>

    <div class="p-2">
      <v-select
          appendToBody
          v-model="options"
          :options="this.filter.options"
          :placeholder="placeholder"
          :multiple="true"
          label="name"
          track-by="value"
          @input="handleChange"
      >
        <div slot="no-options">{{noOptionsLabel}}}</div>
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
  mounted: function () {
    if (this.filter.currentValue === undefined || this.filter.currentValue === '') {
      return;
    }
    this.filter.options.forEach(option => {
      if (this.filter.currentValue.indexOf(option.value) === -1) {
        return;
      }
      this.options.push(option);
    });
  },
  data: function () {
    return {
      options: [],
    };
  },
  methods: {
    handleChange: function () {
      this.$store.commit(`${this.resourceName}/updateFilterState`, {
        filterClass: this.filterKey,
        value: this.values,
      });
      this.$emit('change');
    },
  },
  computed: {
    filter: function () {
      return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
    },
    values: function () {
      const values = [];
      this.options.forEach(option => {
        values.push(option.value);
      });
      return values.length ? values : '';
    },
    noOptionsLabel: function () {
      return this.filter.noOptionsLabel || this.__('Sorry, no matching options.');
    },
    placeholder: function () {
      return this.filter.placeholder || this.__('Select option');
    },
  },
};
</script>

<style>
.v-select {
  background-color: #fff;
}

.v-select .vs__selected {
  background-color: #4099de;
  color: #fff;
}

.v-select .vs__deselect > svg {
  fill: #fff;
}

.vs__dropdown-menu {
  width: min-content !important;
}

.vs__dropdown-menu .vs__dropdown-option--highlight {
  background: #4099de;
}

.vs__dropdown-menu .vs__dropdown-option--selected {
  display: none;
}
</style>

<style src="vue-select/dist/vue-select.css"></style>
