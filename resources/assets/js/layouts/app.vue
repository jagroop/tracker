<template>
  <div class="main-layout">
    <navbar/>
    <el-container>
      <el-aside width="200px">
        <!-- Aside starts -->
        <el-menu default-active="1" class="el-menu-vertical-demo">          
          <el-menu-item index="1">
            <i class="el-icon-news"></i>
            <span slot="title">Dashboard</span>
          </el-menu-item>
          <el-menu-item index="1">
            <i class="el-icon-tickets"></i>
            <span slot="title">Projects</span>
          </el-menu-item>
          <el-menu-item index="2">
            <fa icon="coffee" fixed-width/>
            <span slot="title">Issues</span>
          </el-menu-item>
          <el-menu-item index="2">
            <i class="el-icon-info"></i>
            <span slot="title">Users</span>
          </el-menu-item>
        </el-menu>
        <!-- Aside ends -->
      </el-aside>
      <el-main>
        <child/>
      </el-main>
    </el-container>
  </div>
</template>
<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'AppLayout',

  components: {
    Navbar
  }
}
</script>
