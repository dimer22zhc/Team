export default ({ store, redirect }) => {
  if (!store.getters['auth/check'] && !store.getters['auth/check_token'] ) {
    return redirect('/login')
  }
}
