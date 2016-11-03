<template>
    <div class="comments">
        <h2>Comments</h2>

        <div v-for="comment in comments" class="comment">
            <h5>{{ comment.username }} said:</h5>
            <p>{{ comment.comment }}</p>
        </div>

        <form method="POST" v-on:submit.prevent="submit" :action="post_url">
            <textarea v-model="new_comment" name="comment" placeholder="New Comment..."></textarea>
            <input type="submit"/>
        </form>

    </div>
</template>

<script>
    var Vue = require('vue');

    export default {
        props: ['post_url','comments_url','post_id'],
        methods: {
            submit: function(){
                var self = this;
                Vue.http.post(this.post_url,{ 'comment':this.new_comment }).then((response) => {
                    self.new_comment = '';
                    self.comments.push(response.data);
                })
            }
        },
        data(){
            return {
                comments:[],
                new_comment:''
            }
        },
        mounted(){
            var self = this;
            Vue.http.get(this.comments_url).then((response) => {
                _.forEach(response.data,function(item){
                    self.comments.push(item);
                })
            })

            Echo.private('comments.'+self.post_id)
                .listen('NewComment', (e) => {
                    self.comments.push(e.comment);
                });

        }
    }
</script>
