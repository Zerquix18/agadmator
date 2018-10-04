<template>
  <b-field class="column is-one-quarter">
    <b-autocomplete
        v-model="value"
        :placeholder="placeholder"
        type="text"
        :data="data"
        :loading="isLoading"
        @input="getData"
        @select="option => value = option"
        :icon="icon"
        :id="field">
    </b-autocomplete>
  </b-field>
</template>

<script>
export default {
  props: ['placeholder', 'field', 'icon'],
  data: function () {
    return {
      value: '',
      data: [],
      isLoading: false,
    };
  },
  methods: {
    getData: function () {
      const option    = this.field;
      const { value } = this;

      this.data = [];
      this.isLoading = true;

      fetch(window.completeUrl + '?' + option + '=' + value)
      .then((response) => {
        if (response.ok) {
          return response.json();
        }
        return null;
      })
      .then((result) => {
        if (result) {
          this.data = result[option];
        }
      })
      .finally(() => {
        this.isLoading = false;
      });
    }, // premise
  } // methods
} // export
// ya mama!
</script>
