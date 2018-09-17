<template>
  <div class="main-layout">
    <navbar/>
    <el-container>
      <el-aside width="200px">
        <!-- Aside starts -->
        <el-menu :default-active="current_active_tab" class="el-menu-vertical-demo" @select="switchTab">          
          <el-menu-item index="home">
            <i class="el-icon-news"></i>
            <span slot="title">Dashboard</span>
          </el-menu-item>
          <el-menu-item index="projects">
            <i class="el-icon-tickets"></i>
            <span slot="title">Projects</span>
          </el-menu-item>
          <el-menu-item index="tasks">
            <i class="el-icon-circle-check-outline"></i>
            <span slot="title">Tasks</span>
          </el-menu-item>
          <el-menu-item index="issues">
            <i class="el-icon-info"></i>
            <span slot="title">Issues</span>
          </el-menu-item>
          <el-menu-item index="users">
            <i class="el-icon-location"></i>
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
import { mapGetters } from 'vuex'
import Push from 'push.js'

export default {
  name: 'AppLayout',

  components: {
    Navbar
  },
  data() {
    return {
      current_active_tab: 'home'
    }
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
  mounted() {
    var self = this;
    Push.Permission.request();
    WS.onmessage = function(e) { 
      console.log('here');
      const msg = JSON.parse(e.data);
      const user = self.user;
      console.log(user.id, user.name);
      if(user.id === msg.receiver) {
        Push.create(msg.title, {
            body: msg.content,
            timeout: 8000
        });
      }
    };
    console.log(this.user);
  },
  methods: {
    switchTab(index) {
      this.current_active_tab = index;
      this.$router.push({ name: index })
    }
  }
}
</script>
<style>
  .invalid-feedback {
    display: block;
  }
</style>
