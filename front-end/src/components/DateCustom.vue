<template>
  <v-text-field
    clearable
    label="Data de venda *"
    v-model="formattedDateTime"
    @input="updateDateTime"
    @blur="validateDateTime"
  ></v-text-field>
</template>

<script>
export default {
  data() {
    return {
      dateTime: '',
      formattedDateTime: '',
    };
  },
  methods: {
    updateDateTime(value) {
      // Remove caracteres inválidos e formata a entrada conforme necessário
      this.formattedDateTime = value.replace(/[^0-9/ :]/g, '');
      this.dateTime = this.formattedDateTime;
    },
    validateDateTime() {
      // Adiciona validação para garantir que a data esteja no formato correto
      const regex = /^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}$/;
      if (!regex.test(this.formattedDateTime)) {
        alert('Por favor, insira uma data válida no formato dd/mm/yyyy hh:mm');
      }
    },
  },
};
</script>

<style scoped>
</style>
