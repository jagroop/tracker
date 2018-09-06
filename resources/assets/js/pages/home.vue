<template>
  <card :title="$t('home')">
      <router-link :to="{ name: 'test' }">Test Page</router-link>
    {{ $t('you_are_logged_in') }}
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
