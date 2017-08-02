<template>
    <ul id="slide-out" class="side-nav">
        <li>
            <div class="userView">
                <div class="background"><img src="img/leaf_background.jpg" alt=""></div>
                <a><img src="https://secure.gravatar.com/avatar/beef4a109b5744b8b51537c0136f7e3b" alt="" class="circle"></a>
                <a><span class="white-text name">{{user.name}}</span></a>
                <a :href="'mailto:' + user.email"><span class="white-text email">{{user.email}}</span></a>
            </div>
        </li>

        <li><a href="" class="subheader">Bot Manager</a></li>
        <li><a href="#/" class="waves-effect">Postbacks</a></li>
        <li><a href="#/menus" class="waves-effect">Menus</a></li>

        <li><a href="" class="subheader">Conteúdos</a></li>
        <li><a href="#/products" class="waves-effect">Produtos</a></li>
        <li><a href="#/suggestions" class="waves-effect">sugestões</a></li>
    </ul>
</template>

<script>
    export default {
      computed: {
        user: function () {
          return this.$store.state.user.user
        }
      },
      mounted() {
        $('#nav-mobile').sideNav();
      }
    }
</script>