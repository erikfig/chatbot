<template>
  <div>
    <h3>Menus do bot</h3>
    <button class="btn red margin-botton" @click="removeMenu()">Limpar menu no Facebook</button>

    <div v-if="menus.data.length > 0" class="margin-botton row">
      <router-link
      v-for="menu in menus.data"
      class="col s12 waves-effect waves-light btn-large light-green margin-botton"
      :to="{path: 'menu/' + menu.id}">
        {{ menu.locale }} <small>Campo de mensagem: {{ menu.compuser_input_disabled ? 'ativado' : 'desativado' }}</small>
      </router-link>
    </div>
    <div class="card red" v-if="menus.data.length === 0">
      <div class="card-content white-text">
        Nenhum menu cadastrado...
      </div>
    </div>

    <form @submit.prevent="save()">
      <legend>Novo menu</legend>

      <div class="row">
        <div class="input-group col s6">
          <input type="text" placeholder="Locale" v-model="locale" required>
        </div>
        <div class="input-group col s6">
          <p>
            <a href="https://developers.facebook.com/docs/messenger-platform/messenger-profile/supported-locales" target="_blank">Clique aqui para ver os locales suportados</a>
          </p>
        </div>
        <div class="input-group margin-botton col s12">
          <input id="composer_input_disabled" type="checkbox" v-model="composer_input_disabled" checked>
          <label for="composer_input_disabled">Exibir campo de mensagem?</label>
        </div>
        <div class="input-group col s12">
          <input type="submit" value="+" class="btn" required>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import swal from 'sweetalert'

  export default {
    data: function () {
      return {
        locale: 'default',
        composer_input_disabled: true
      }
    },
    methods: {
      save: function () {
        let data = {
          locale: this.locale,
          composer_input_disabled: this.composer_input_disabled
        }

        this.$store.dispatch('newMenu', data).then(() => {
          this.$store.dispatch('getMenus')
          this.locale = 'default'
          this.composer_input_disabled = true
        })
      },
      removeMenu: function () {
        swal(
          {
            title: "Removendo TODOS os menus no Facebook!!!",
            text: "Você está removendo os menus cadastrados no Facebook, você terá que sincronizar um por um novamente!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColler: "#DD6B55",
            confirmButtonText: "Remover!",
            cancelButtonText: "Cancelar"
          },
          () => {
            this.$store.dispatch('removeFromFacebook').then(() => {
              swal("Removido!", "Removido com sucesso.", "success")
              this.$store.dispatch('getMenus')
            })
          }
        )
      }
    },
    computed: {
      menus () {
        return this.$store.state.menu.listMenus
      }
    },
    mounted () {
      this.$store.dispatch('getMenus')
    }
  }
</script>

<style>
  .margin-botton {
    margin-bottom: 20px;
  }
</style>