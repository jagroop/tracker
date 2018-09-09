<template>
  <div>
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>Projects</span>
        <el-button v-if="user.role == 'admin'" style="float: right; padding: 3px 0" type="text" @click="add_project_dialog_show = true">Add Project</el-button>
      </div>
      <el-table
      :data="projects"
      :default-sort = "{prop: 'created_at', order: 'descending'}"
      v-loading="table_loading"
      style="width: 100%">
        <el-table-column
          prop="name"
          label="Name"
          sortable>
        </el-table-column>
        <el-table-column
          prop="status_formated"
          label="Status">
          <template slot-scope="scope">
            <el-tag
              :type="statuses[scope.row.status]"
              disable-transitions>{{scope.row.status_formated}}</el-tag>
          </template>
        </el-table-column>
        <el-table-column
          prop="created_at"
          label="Created At">
        </el-table-column>
        <el-table-column
          v-if="user.role == 'admin'"
          label="Actions">
          <template slot-scope="scope">
            <el-button type="text" size="small" @click="editProject(scope.$index, projects)">Edit</el-button>
            <el-button type="text" size="small" @click="deleteProject(scope.$index, projects)">Delete</el-button>
          </template>
        </el-table-column>
      </el-table>

      <el-pagination
        background
        layout="prev, pager, next"
        style="float: right; padding: 12px"
        :total="total_projects"
        :page-size="per_page"
        @current-change="loadProjects"
        >
      </el-pagination>

    </el-card>   

    <!-- Add Project Dialog starts -->
    <el-dialog
    title="Add new project"
    :visible.sync="add_project_dialog_show"
    width="30%">
      <el-form ref="form" :model="form" label-width="120px">
        <el-form-item label="Project name">
          <el-input v-model="form.name"></el-input>
          <has-error :form="form" field="name" />
        </el-form-item>
        <el-form-item label="Project status">
          <el-select v-model="form.status" placeholder="Select status">
            <el-option label="In Progress" value="in_progress"></el-option>
            <el-option label="Done" value="done"></el-option>
            <el-option label="On hold" value="on_hold"></el-option>
            <el-option label="Closed" value="closed"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" :loading="form.busy" @click="saveProject">Create</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <!-- Add Project Dialog ends -->

    <!-- Edit Project Dialog starts -->
    <el-dialog
    title="Edit project"
    :visible.sync="edit_project_dialog_show"
    width="30%">
      <el-form ref="edit_form" :model="edit_form" label-width="120px">
        <el-form-item label="Project name">
          <el-input v-model="edit_form.name"></el-input>
          <has-error :form="edit_form" field="name" />
        </el-form-item>
        <el-form-item label="Project status">
          <el-select v-model="edit_form.status" placeholder="Select status">
            <el-option label="In Progress" value="in_progress"></el-option>
            <el-option label="Done" value="done"></el-option>
            <el-option label="On hold" value="on_hold"></el-option>
            <el-option label="Closed" value="closed"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" :loading="edit_form.busy" @click="updateProject">Update</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <!-- Edit Project Dialog ends -->

  </div>
</template>

<script>
  import axios from 'axios'
  import { mapGetters } from 'vuex'
  import Form from 'vform'

  export default {
    layout: 'app',
    middleware: 'auth',
    metaInfo () {
      return { title: 'Projects' }
    },
    data() {
      return {
        projects: [],
        statuses: {
          in_progress: 'success',
          done: 'primary',
          on_hold: 'danger',
        },
        current_project: {
          id: null,
          index: null,
        },
        total_projects: 0,
        per_page: 0,
        table_loading: true,
        add_project_dialog_show: false,
        edit_project_dialog_show: false,
        form: new Form({
          name: '',
          status: 'in_progress'
        }),
        edit_form: new Form({
          name: '',
          status: 'in_progress'
        }),
      }
    },
    mounted() {
        this.loadProjects(1);
    },
    computed: mapGetters({
      user: 'auth/user'
    }),
    methods: {
      loadProjects(page) {
       var self = this;
       self.table_loading = true;
       axios.get('/api/v1/projects?page='+page)
          .then(function (response) {
              self.total_projects = parseInt(response.data.meta.total);
              self.per_page = parseInt(response.data.meta.per_page);
              self.projects = response.data.data;
              self.table_loading = false;
          })
          .catch(function (error) {
              console.log(error);
          });
      },
      async saveProject() {
        var self = this;
        const { data } = await this.form.post('/api/v1/projects');
        self.projects.unshift(data);
        self.total_projects++;
        self.form.name = '';
        self.form.status = 'in_progress';
        self.add_project_dialog_show = false;
      },
      editProject(index, projects) {
        var self = this;
        if(typeof projects[index] != 'undefined') {
          self.edit_project_dialog_show = true;
          const project = projects[index];
          self.current_project.index = index;
          self.current_project.id = project.id;
          self.edit_form.name = project.name;
          self.edit_form.status = project.status;          
        }
      },
      async updateProject() {
        var self = this;
        const { data } = await this.edit_form.patch('/api/v1/projects/'+self.current_project.id);
        let project = self.projects[self.current_project.index];
        project.name = data.name;
        project.status_formated = data.status_formated;
        self.edit_project_dialog_show = false;
      },
      deleteProject(index, projects) {
        var self = this;
        if(typeof projects[index] != 'undefined') {
          this.$confirm('This will permanently delete the record. Continue?', 'Warning', {
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel',
            type: 'warning'
          }).then(() => {
            const { data } = this.edit_form.delete('/api/v1/projects/'+projects[index].id);
            self.total_projects--;
            self.projects.splice(index, 1);
          });       
        }
      },
      formatter(row, column) {
        return row.address;
      },
      filterTag(value, row) {
        return row.tag === value;
      },
      filterHandler(value, row, column) {
        const property = column['property'];
        return row[property] === value;
      }
    },
  }
</script>
