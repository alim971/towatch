<template>
    <div>
        <input type="text" placeholder="what movie are you looking for?" v-model="query" v-on:keyup="autoComplete" class="form-control">
        <div class="panel-footer" v-if="results.length">
            <ul class="list-group">
                <li class="list-group-item hoverable" v-on:click="select(result)" v-for="result in results">
                    <span class="" >{{ result.name }}</span>
                </li>
                <li class="list-group-item hoverable" v-on:click="select('-x-')">
                    <i class="fa fa-times"></i>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            query: '',
            results: []
        }
    },
    methods: {
        autoComplete(){
            this.results = [];
            if(this.query.length >= 1){
                this.selected = '';
                axios.get('/auto',{params: {query: this.query}}).then(response => {
                    this.results = response.data;
                });
            }
        },
        select(result) {
            if(result === "-x-") {
                this.results = [];
                return;
            }
            this.query = result.name;
            // this.selected = name;
            this.results = [];
            window.location.href = '/movies/' + result.id + '/showing';
        }
    }
}
</script>
