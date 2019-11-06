import Vue from 'vue'

Vue.filter('initials', function (value) {
  if (!value) return ''
  value = value.split('@')[0]
  return value.substring(0,2).toUpperCase()
})

Vue.filter('name', function (value) {
  if (!value) return ''
  return value.split('@')[0]
})

Vue.filter('team', function (value) {
  if (!value) return ''
  value = value.split(' ')[0]
  return value.substring(0,2).toUpperCase()
})

Vue.filter('emojie', function (value) {
  if (!value) return ''
  value = value.split('/')[0]
  return value
})

Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.charAt(0).toUpperCase() + value.slice(1)
  return value
})
