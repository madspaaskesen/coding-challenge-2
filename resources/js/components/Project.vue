<template>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 v-text="project.name"></h4>
                </div>
                <div class="col-2">
                    <div class="text-right">
                        <button type="button" class="btn btn-sm btn-secondary" @click.prevent="deleteProject">Delete</button>
                        <button v-show="runningState" type="button" class="btn btn-sm btn-danger" @click.prevent="stopTimer">Stop</button>
                        <button v-show="!runningState" type="button" class="btn btn-sm btn-success" @click.prevent="startTimer">Start</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="card-table table">
            <thead>
                <tr>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Time spent</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="entry in project.entries">
                    <td v-text="entry.start"></td>
                    <td v-text="entry.end"></td>
                    <td>
                        {{ hours(entry.start, entry.end) }} hours
                    </td>
                    <td class="text-right">
                        <button type="button" class="btn btn-sm btn-secondary" @click.prevent="deleteEntry(entry)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    name: "Project",
    props: ['project', 'running'],
    data: () => ({
        runningState: false
    }),
    created() {
        this.runningState = this.running
    },
    methods: {
        startTimer() {
            this.runningState = true
            this.callStartStopAjax('start')
        },
        stopTimer() {
            this.runningState = false
            this.callStartStopAjax('stop')
        },
        hours(start, end) {
            let hours = 0
            if (end !== null) {
                let startMoment = moment(start, 'YYYY-MM-DD hh:mm:ss')
                let endMoment = moment(end, 'YYYY-MM-DD hh:mm:ss')
                hours = endMoment.diff(startMoment, 'hours', true)
            }
            return Number(hours).toFixed(2)
        },
        deleteProject() {
            if (window.confirm('Are you sure you want to delete this project?')){
                axios
                    .post('/projects/delete', { id: this.project.id })
                    .then(response => { window.location.href = '/home' })
            }
        },
        deleteEntry(entry) {
            if (window.confirm('Are you sure you want to delete this entry?')){
                axios
                    .post('/entries/delete', { id: entry.id })
                    .then(response => { window.location.reload() })
            }
        },
        callStartStopAjax(startStop) {
            axios
                .post('/entries/' + startStop, {
                    projectId: this.project.id
                })
                .then(response => {
                    window.location.reload()
                })
                .catch(error => {
                    if (error.response.data.status === 'error') {
                        alert(error.response.data.message)
                    }
                    else {
                        console.error("There was an error!", error)
                    }
                })
        }
    }
}
</script>
