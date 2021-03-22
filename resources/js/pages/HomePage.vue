<template>
  <span>
    <div class="container">
      <h1 class="text-center mb-4 mt-4">Agendamento online</h1>
      <div class="row">
        <div class="col-md-4 offset-md-4 mt-4 mb-4">
          <select
            class="form-control"
            aria-label="Default select example"
            v-model="specialtie_selected"
            @change="getProfessional()"
          >
            <option selected disabled>Selecione uma especialidade</option>
            <option
              v-for="specialtie in specialties"
              :key="specialtie.especialidade_id"
              v-bind:value="specialtie.especialidade_id"
            >
              {{ specialtie.nome }}
            </option>
          </select>
        </div>
      </div>
      <div class="row mt-4">
        <div
          class="col-md-3"
          v-for="professional in professionals"
          :key="professional.profissional_id"
        >

          <div class="card mt-4">
            <img
              v-if="professional.sexo == 'Feminino'"
              class="card-img-top"
              src="https://i.ibb.co/Px64wWw/doctor-2.png"
              alt="Card image cap"
              style="border-radius: 50%"
            />
            <img
              v-else
              class="card-img-top"
              src="https://i.ibb.co/59zvq9b/doctor-1.png"
              alt="Card image cap"
              style="border-radius: 50%"
            />
            <div class="card-body">
              <h5 class="card-title">{{ professional.nome || "Nome: não informado" }}</h5>
              <p class="card-text">
                {{ professional.documento_conselho || "CRM: Não informado" }}
              </p>
              <button
                :specialtie_selected="specialtie_selected"
                :professional_selected="
                  (professional_selected = professional.profissional_id)
                "
                class="text-center text-weight btn btn-success"
                data-toggle="modal"
                data-target="#modal"
              >
                Agendar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agendar Consulta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <input
                  v-model="name"
                  class="form-control"
                  value=""
                  placeholder="Nome completo"
                />
              </div>
              <div class="col-md-6">
                <select
                  class="form-control"
                  aria-label="Default select example"
                  v-model="channel_selected"
                >
                  <option selected disabled>Selecione canal</option>
                  <option
                    v-for="channel in channels"
                    :key="channel.origem_id"
                    v-bind:value="channel.origem_id"
                  >
                    {{ channel.nome_origem }}
                  </option>
                </select>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-6">
                <datetime
                  v-model="birthdate"
                  input-class="form-control"
                  type="date"
                  value-zone="America/Sao_Paulo"
                  format="dd-MM-yyyy"
                  placeholder="Nascimento"
                >
                </datetime>
              </div>
              <div class="col-md-6">
                <input
                  v-model="cpf"
                  v-mask="'###.###.###-##'"
                  type="text"
                  class="form-control"
                  id="cpf"
                  placeholder="CPF"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Cancelar
            </button>
            <button
              @click="
                register(specialtie_selected, professional_selected, channel_selected)
              "
              type="button"
              class="btn btn-primary"
            >
              Solicitar horários
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--/ Modal -->
  </span>
</template>

<script>
import helperMethods from "../mixins/helperMethods.js";
import VueToast from "vue-toast-notification";
Vue.use(VueToast);

export default {
  data() {
    return {
      name: "",
      cpf: "",
      source_id: "",
      birthdate: "",
      specialties: [],
      professionals: [],
      channels: [],
      previewImage: "",
      title_specialtie: "",
      professional_selected: "",
      specialtie_selected: "",
      channel_selected: "",
      butonSave: true,
      req: false,
      sendData: "",
    };
  },
  mixins: [helperMethods],
  mounted() {
    this.getAllSpacialties();
    this.getChannels();
    this.toggleModal();
  },
  props: [],
  methods: {
    getAllSpacialties: function () {
      window.axios
        .get(`${process.env.MIX_URL_SERVICE}/api/scheduling/specialties`) //${process.env.MIX_URL_SERVICE}
        .then((res) => {
          this.specialties = res.data.content;
        })
        .catch((erro) => {
          Vue.$toast.open({
            message: erro.message,
            type: "error",
            position: "top-right",
          });
        });
    },
    getProfessional: function (id_especialty) {
      window.axios
        .get(
          `${process.env.MIX_URL_SERVICE}/api/scheduling/professionals/${this.specialtie_selected}`
        )
        .then((res) => {
          this.professionals = res.data.content;
          console.log(this.professionals);
        })
        .catch((erro) => {
          Vue.$toast.open({
            message: "Ocorreu um erro!",
            type: "error",
            position: "top-right",
          });
        });
    },
    getChannels: function () {
      window.axios
        .get(`${process.env.MIX_URL_SERVICE}/api/scheduling/channels/list-sources`)
        .then((res) => {
          this.channels = res.data.content;
          console.log(this.professionals);
        })
        .catch((erro) => {
          Vue.$toast.open({
            message: "Ocorreu um erro!",
            type: "error",
            position: "top-right",
          });
        });
    },
    register: function (specialty_id, professional_id, channel_selected) {
      this.toggleClassButton("save", "", "fa fa-spinner fa-spin");
      if (this.sendData == "") {
        this.sendData = new FormData();
      }
      this.sendData.append("name", this.name);
      this.sendData.append("birthdate", this.birthdate);
      this.sendData.append("cpf", this.cpf);

      this.sendData.append("specialty_id", specialty_id);
      this.sendData.append("professional_id", professional_id);
      this.sendData.append("source_id", channel_selected);

      window.axios
        .post(`${process.env.MIX_URL_SERVICE}/api/scheduling`, this.sendData)
        .then((res) => {
          Vue.$toast.open({
            message: "Consulta Agendada!",
            type: "success",
            position: "top-right",
          });
          this.butonSave = true;
          this.getAllSpacialties();
          this.modalHide();
          this.toggleClassButton("save", "", "fa fa-spinner fa-spin", "");
        })
        .catch((erro) => {
          Vue.$toast.open({
            message: "Ocorreu um erro!",
            type: "error",
            position: "top-right",
          });
          this.butonSave = true;
          this.toggleClassButton("save", "", "fa fa-spinner fa-spin", "");
        });
    },
  },
};
</script>
