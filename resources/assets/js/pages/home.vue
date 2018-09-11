<template>
  <!-- <el-row :gutter="12">
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
  </el-row> -->

  <div>
    <el-upload
      class="upload-demo"
      drag
      action="api/v1/files"
      :on-preview="handlePreview"
      :on-remove="handleRemove"
      :file-list="fileList"
      list-type="text"
      :auto-upload="true"
      :data="{ model_id: '1', model_name: 'project'}"
      multiple>
      <i class="el-icon-upload"></i>
      <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
      <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
    </el-upload>
    <img src="http://localhost:8000/storage/tracker_files/1/lumen.png" alt="">
  </div>
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
        fileList: []
      }
    },
    methods: {
      handleRemove() {

      },
      handlePreview() {

      }
    }
  }
</script>