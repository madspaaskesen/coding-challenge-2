<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-10">
                        <h4>Projects</h4>
                    </div>
                    <div class="col-2">
                        <div class="text-right">
                            <button type="button" class="btn btn-sm btn-success" @click.prevent="addProject">Add project</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="card-table table">
                <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Entries</th>
                    <th>Total hours</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects">
                        <td v-text="project.name"></td>
                        <td v-text="project.entries.length"></td>
                        <td>
                            {{ entriesHours(project.entries) }} hours
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-sm btn-dark" @click.prevent="editProject(project)">Edit</button>
                            <a :href="`/projects/${project.id}`" class="btn btn-sm btn-secondary">Details</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <add-project ref="add"></add-project>
        <edit-project ref="edit"></edit-project>
    </div>
</template>

<script>
import AddProject from "./AddProject"
import EditProject from "./EditProject"
import moment from "moment"

export default {
    name: "Projects",
    components: {
        'add-project': AddProject,
        'edit-project': EditProject
    },
    props: ['projects'],
    methods: {
        addProject() {
            this.$refs.add.open()
        },
        editProject(project) {
            this.$refs.edit.open(project)
        },
        entriesHours(entries) {
            let hours = 0
            for (let entryIndex in entries) {
                let entry = entries[entryIndex]
                if (entry.end !== null) {
                    let startMoment = moment(entry.start, 'YYYY-MM-DD hh:mm:ss')
                    let endMoment = moment(entry.end, 'YYYY-MM-DD hh:mm:ss')
                    hours += endMoment.diff(startMoment, 'hours', true)
                }
            }
            return Number(hours).toFixed(2)
        }
    }
}
</script>
