<template>
  <div class="form-container">
    <form @submit.prevent="submitForm" class="form">
      <label for="variant" class="label">Select a company:</label>
      <select id="variant" v-model="formData.company" class="select" required>
        <option value="" disabled>Select a company</option>
        <option v-for="variant in companies" :key="variant.name" :value="variant.class">
          {{ variant.name }}
        </option>
      </select>

      <input type="number" placeholder="weight" v-model="formData.weight" class="input" min="1" max="9999" required>
      <button type="submit" class="button">Calculate price</button>
    </form>
    <div v-if="result" class="result">Calculated price = {{ result }} EUR</div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      formData: {
        company: null,
        weight: null,
      },
      backend_url: 'http://localhost',
      companies: null,
      result: null,
    };
  },
  methods: {
    submitForm() {
      axios.post(this.backend_url + '/calculate', this.formData)
          .then(response => {
            this.result = response.data.price;
          })
          .catch(error => {
            console.error(error);
          });
    },
    getCompanies() {
      axios.get(this.backend_url + '/companies')
          .then(response => {
            console.log(response);
            this.companies = response.data.companies;
          })
    }
  },
  mounted() {
    this.getCompanies();
  }
};
</script>

<style scoped>
.form-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px;
}

.form {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 1px solid #ccc;
  padding: 20px;
  border-radius: 5px;
  width: 300px;
}

.label {
  font-weight: bold;
  margin-bottom: 10px;
}

.select,
.input,
.button {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
}

.button {
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
}

.button:hover {
  background-color: #0056b3;
}

.result {
  margin-top: 20px;
  font-weight: bold;
}
</style>
