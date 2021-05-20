<template>
    <div>
        <input type="text"
               placeholder="what movie are you looking for?"
               v-model="query"
               @focus="focus()"
               @blur="blur()"
               v-on:keyup="autoComplete"
               class="form-control">
        <div class="panel-footer" v-if="results.length && magic_flag">
            <ul class="list-group">
                <li class="list-group-item hoverable"
                    @click="select(result)"
                    @mouseover="hovering"
                    @mouseout="unhovering"
                    v-for="result in results"
                >
                    <span>{{ result.name }}</span>
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
            results: [],
            magic_flag: false,
            hover: false
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
            this.query = result.name;
            this.hover = false;
            this.blur("selected");
            this.results = [];
            window.location.href = '/movies/' + result.id + '/showing';
        },
        focus(a) {
            this.magic_flag = true;
        },
        blur(a) {
            if(!this.hover) {
                this.magic_flag = false;
            }
        },
        hovering() {
            this.hover = true;
        },
        unhovering() {
            this.hover = false;
        }
    }
}
</script>
