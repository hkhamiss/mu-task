<template>
    <div class="flex items-center justify-center h-screen">
        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" v-on:click="restPostForm()"><b v-if="lang == 'en'">Add New Post</b><b v-if="lang == 'ar'">أضافة منشور جديد</b></button>
    </div>
    <div class="fixed z-10 overflow-y-auto top-2 left-8 hidden" id="modal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75" />
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form v-if="update_mode" @submit.prevent="updatePost()" enctype="multipart/form-data">

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                        <div class="input-group">
                            <input type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="post.title" v-model="post.title"  placeholder="Write a title...">
                        </div>

                        <div class="input-group">
                            <textarea class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="post.body" v-model="post.body" placeholder="Write a body..."></textarea>
                        </div>
                </div>

                    <div class="bg-gray-200 px-4 py-3 text-right">
                        <button  class="iinline-flex items-center space-x-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit"><b v-if="lang=='en'">Save</b> <b v-else>حفظ</b></button>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" v-on:click="restPostForm()"><b v-if="lang=='en'">Cancel</b> <b v-else>الغاء</b> </button>
                    </div>
                </form>

                <form v-else @submit.prevent="addPost()" enctype="multipart/form-data">

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                        <div class="input-group">
                            <input type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="postform.title" v-model="postform.title"  placeholder="Write a title...">
                        </div>

                        <div class="input-group">
                            <textarea class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" name="postform.body" v-model="postform.body" placeholder="Write a body..."></textarea>
                        </div>
                    </div>

                    <div class="bg-gray-200 px-4 py-3 text-right">
                        <button  class="iinline-flex items-center space-x-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit"><b v-if="lang=='en'">Save</b> <b v-else>حفظ</b></button>
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" v-on:click="restPostForm()"><b v-if="lang=='en'">Cancel</b> <b v-else>الغاء</b> </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <ul class="timeline">
        <li v-for="post in posts" :key="post.id">
            <!-- begin timeline-time -->
            <div class="timeline-time">
                <span class="date">{{post.created_at}}</span>
                <span class="time"></span>
            </div>
            <!-- end timeline-time -->
            <!-- begin timeline-icon -->
            <div class="timeline-icon">
                <a href="javascript:;">&nbsp;</a>
            </div>
            <!-- end timeline-icon -->
            <!-- begin timeline-body -->
            <div class="timeline-body">
                <div class="timeline-likes" v-if="postform.user_id == post.owner.id">
                    <div class="stats-right">
                        <form @submit.prevent="deletePost">
                            <input type="hidden" name="post_id" :value="post.id"/>
                            <span class="stats-text"><button type="submit"><b style="color: red !important;">X</b></button></span>
                        </form>
                    </div>
                    <div class="stats-right">
                        <form @submit.prevent="getPost">
                            <input type="hidden" name="post_id" :value="post.id"/>
                            <span class="stats-text"><button type="submit"><b style="color: green !important;">edit</b></button></span>
                        </form>
                    </div>
                </div>



                <div class="timeline-header">
                    <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt=""></span>
                    <span class="username"><a href="javascript:;">{{post.title}}</a> <small></small></span>
                </div>
                <div class="timeline-content">
                    <p>
                        {{post.body}}
                    </p>
                </div>
                <div class="timeline-likes">
                    <div class="stats-right">
                        <span class="stats-text">{{post.comments.length}} <b v-if="lang == 'en'">Comments</b><b v-else>تعليقات</b></span>
                    </div>
                    <div class="stats">

                    </div>
                </div>
                <div class="timeline-footer">
                    <ul>
                        <li v-for="comment in post.comments" :key="comment.id">
                           <i class="fa fa-comments fa-fw fa-lg m-r-3"></i>{{comment.comment}}
                            <div class="timeline-likes" v-if="postform.user_id == post.owner.id">
                                <div class="stats-right">
                                    <form @submit.prevent="deleteComment">
                                        <input type="hidden" name="comment_id" :value="comment.id"/>
                                        <span class="stats-text"><button type="submit"><b style="color: red !important;">X</b></button></span>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="timeline-comment-box">
                    <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar1.png"></div>
                    <div class="input">
                        <form @submit.prevent="addComment">
                            <div class="input-group">
                                <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm me-px" name="comment"  placeholder="Write a comment...">
                                <input type="hidden" name="post_id" :value="post.id">
                                <span class="input-group-btn p-l-10">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" type="submit"><b v-if="lang == 'en'">Add Comment</b> <b v-else>اضافة تعليق</b></button>
                                </span>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- end timeline-body -->
        </li>
    </ul>




</template>


<script>
import axios from "axios";


var csrf_token = document.head.querySelector('meta[name="csrf-token"]').content;
var user_id = document.head.querySelector('meta[name="user_id"]').content;
var lang = document.head.querySelector('meta[name="app-lang"]').content;
console.log(csrf_token);
export default {
    data(){
        return{
            posts:[],
            post:{},
            post_form_method:'addPost',
            update_mode:false,
            lang:lang,
            form:  {
                comment:'',
                user_id:user_id,
                post_id:'',
                _token:csrf_token
            },
            postform:{
                title:'',
                body:'',
                user_id:user_id,
                _token:csrf_token
            }
     }},
    mounted() {
      this.fetchPosts();

    },
    methods:{
        fetchPosts(){
            axios.get('/posts').then(response => this.posts = response.data ).catch(error=> console.log(error));
        },
        addComment(submitEvent){
            this.form.post_id=  submitEvent.target.elements.post_id.value;
            this.form.comment=  submitEvent.target.elements.comment.value;
            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    _token:csrf_token,
                    user_id:user_id,
                    post_id:this.form.post_id,
                    comment:this.form.comment,
                })
            };
            let response =fetch('/comments', requestOptions).then(this.fetchPosts).catch(error=>console.log(error));
            this.restCommentForm();
        },
        toggleModal() { document.getElementById('modal').classList.toggle('hidden')
        },
        addPost(submitEvent){
            const requestOptions = {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(this.postform)
            };
            let response =fetch('/posts', requestOptions).then(this.fetchPosts).catch(error=>console.log(error));
            this.restPostForm();
        },
        updatePost(submitEvent){
            let post_id=this.post.id;
            const requestOptions = {
                method: "PUT",
                headers: { "Content-Type": "application/json"},
                body: JSON.stringify({
                    _token:csrf_token,
                    title:this.post.title,
                    body:this.post.body,
                })
            };
            let response =fetch('/posts/'+post_id, requestOptions).then(this.fetchPosts).catch(error=>console.log(error));
            this.restPostForm();
        }
        ,getPost(submitEvent){
            this.update_mode=true;
            let post_id=submitEvent.target.elements.post_id.value;
            axios.get('/posts/'+post_id).then(response => this.post= response.data ).catch(error=> console.log(error));

            this.postform.title=this.post.title;
            this.postform.body=this.post.body;
            this.toggleModal();
        },


        restPostForm(){
            this.postform.title='';
            this.postform.body='';
            this.update_mode=false;
            this.toggleModal();
        },


        restCommentForm(){
            this.form.comment='';
        },


        deletePost(submitEvent){
            let post_id=submitEvent.target.elements.post_id.value;
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    _token:csrf_token,
                })
            };
            let response =fetch('/posts/'+post_id, requestOptions).then(this.fetchPosts).catch(error=>console.log(error));
            this.fetchPosts()
        },
        deleteComment(submitEvent){
            let comment_id=submitEvent.target.elements.comment_id.value;
            const requestOptions = {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    _token:csrf_token,
                })
            };
            let response =fetch('/comments/'+comment_id, requestOptions).then(this.fetchPosts).catch(error=>console.log(error));
            this.fetchPosts()
        },
    }
}

</script>
