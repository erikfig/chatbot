<template>
  <div class="row">
    <div class="col s8 push-s2">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Acessar</span>
          <form @submit.prevent="login()">
            <div class="input-field">
              <label for="email">E-Mail</label>
              <input id="email" type="email" name="email" required autofocus v-model="credentials.email">
            </div>

            <div class="input-field">
              <label for="password">senha</label>
              <input id="password" type="password" name="password" required v-model="credentials.password">
            </div>

            <div>
              <input id="remember" type="checkbox" name="remember" v-model="credentials.remember">
              <label for="remember">Lembrar de mim</label>
            </div>

            <hr>

            <button type="submit" class="btn">
              Login
            </button>

            <a href="#/register" class="btn green">Cadastre-se</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import swal from 'sweetalert'

  export default {
    data: function() {
      return {
        credentials: {}
      }
    },
    methods: {
      login() {
        window.axios.post('/login', this.credentials)
          .then((res) => {
            if (res.data.status === 'success') {
              swal('Autenticado com sucesso', 'Redirecionando para o painel', 'success')
              this.$router.push({path: '/'})
            } else {
              swal('Falha ao autenticar!', 'Usuário ou senha inválidos', 'error')
            }
          })
          .catch(() => {
            swal('Falha ao autenticar!', 'Usuário ou senha inválidos', 'error')
          })

      }
    }
  }
</script>