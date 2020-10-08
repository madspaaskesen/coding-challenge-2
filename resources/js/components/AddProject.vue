<template>
    <div class="modal" tabindex="-1" role="dialog" ref="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Project</h5>
                    <button type="button" class="close" @click.prevent="closeModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="project-add-form" @submit.prevent="submit">
                        <div class="form-group">
                            <label for="project_name">Project name</label>
                            <input type="text" name="project_name" id="project_name" class="form-control"
                                   :class="{ 'is-invalid': projectNameError !== ''}"
                                   v-model="projectName"
                                   autofocus />
                            <span role="alert" class="invalid-feedback" v-html="projectNameError"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click.prevent="closeModal">Cancel</button>
                    <button type="button" class="btn btn-success" @click.prevent="submit">Save project</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        projectName: '',
        projectNameError: ''
    }),
    methods: {
        open() {
           $(this.$refs.modal).modal('show')
           $(this.$refs.modal).find('#project_name').focus()
        },
        closeModal() {
            $(this.$refs.modal).modal('hide')
            this.projectName = ''
            this.projectNameError = ''
        },
        submit() {
            axios
                .post('/projects/add', {
                    name: this.projectName
                })
                .then(response => {
                    if (response.data.status === 'success') {
                        $(this.$refs.modal).modal('hide')
                        window.location.reload()
                    }
                })
                .catch(error => {
                    if (error.response.data.status === 'error') {
                        this.projectNameError = error.response.data.message
                    }
                    else {
                        console.error("There was an error!", error)
                    }
                })
        }
    }
}
</script>
