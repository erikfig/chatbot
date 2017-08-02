export default {
  state: {
    user: {data: {}},
  },
  mutations: {
    updateUser (state, data) {
      state.user = data
    }
  },
  actions: {
    getCurrentUser(context, message_id) {
      return window.axios.get('/api/v1/users/me').then((response) => {
        context.commit('updateUser', response.data)
        return response;
      })
    }
  }
}