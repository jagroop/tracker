<template>
  <el-row :gutter="12">
    <el-col :span="8">
      <el-card shadow="hover">
        Projects
      </el-card>
    </el-col>
    <el-col :span="8">
      <el-card shadow="hover">
        Issues
      </el-card>
    </el-col>
    <el-col :span="8">
      <el-card shadow="hover">
        Users
      </el-card>
    </el-col>
  </el-row>
</template>

<script>
  export default {
    layout: 'app',
    middleware: 'auth',
    metaInfo () {
      return { title: this.$t('home') }
    },
    data() {
      return {
      }
    },
    methods: {
      
    }
  }
</script>
