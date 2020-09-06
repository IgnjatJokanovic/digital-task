<template>
    <div class="container mt-3">
        <div class="row">
            <div
                v-for="(post, index) in posts"
                v-bind:key="index"
                class="col-lg-4 col-md-6 mb-4 article-holder"
            >
                <div class="card h-100">
                    <img class="card-img-top" :src="post.img" alt />

                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#">{{ post.title }}</a>
                        </h4>
                        <div class="row">
                            <div class="col-6">
                                Published by: {{ post.user.name }}
                            </div>
                            <div class="col-6">
                                {{ post.created_at | moment("D/M/Y") }}
                            </div>
                        </div>
                        <p class="card-text mt-2">
                            {{ post.body.substr(0, 150 - 1) + "..." }}
                        </p>
                    </div>
                    <div class="article-holder--actions">
                        <b-dropdown id="dropdown-edit">
                            <template slot="button-content">
                                <i
                                    class="fa fa-arrow-down"
                                    aria-hidden="true"
                                ></i>
                            </template>
                            <b-dropdown-item>
                                <button
                                    v-b-modal.modal-edit
                                    @click="editShow(post)"
                                    class="btn btn-primary"
                                >
                                    Edit
                                </button></b-dropdown-item
                            >
                            <b-dropdown-item>
                                <button
                                    class="btn btn-primary"
                                    v-on:click="deletePost(post.id, index)"
                                >
                                    Delete
                                </button></b-dropdown-item
                            >
                        </b-dropdown>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <button class="btn btn-primary" @click="paginate(prevPage)">
                Previus
            </button>
            <button class="btn btn-primary ml-2" @click="paginate(nextPage)">
                Next
            </button>
        </div>
        <b-modal id="modal-edit" title="Edit Article">
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    Title <input type="text" v-model="post.title" />
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    Body <input type="text" v-model="post.body" />
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    Picture
                    <input
                        type="file"
                        id="file"
                        ref="image"
                        v-on:change="setImg()"
                    />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-primary mt-3" @click="editPost">
                        Update
                    </button>
                </div>
            </div>
        </b-modal>
    </div>
</template>
<script>
import axios from "axios";
import { fetchCookie } from "../../helpers";
import Vue from "vue";
Vue.use(require("vue-moment"));
export default {
    name: "Articles",
    data() {
        return {
            post: {},
            posts: [],
            nextPage: "",
            prevPage: "",
            url: "/api/"
        };
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            axios
                .get(this.url)
                .then(res => {
                    this.posts = res.data.data;
                    this.nextPage = res.data.next_page_url;
                    this.prevPage = res.data.prev_page_url;
                })
                .catch(err => console.log(err));
        },
        paginate(url) {
            this.url = url;
            this.getPosts();
        },
        deletePost(id, index) {
            confirm("Are yo usure about that?");
            let token = fetchCookie();
            if (token.length > 0) {
                let config = {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                };
                axios
                    .post(`/api/article/delete/${id}`, config)
                    .then(res => {
                        this.posts.splice(index, 1);
                    })
                    .catch(err => console.log(err));
            } else {
                alert("Unauthorised");
            }
        },
        editShow(post) {
            this.post = post;
        },
        editPost() {
            let token = fetchCookie();
            if (token.length > 0) {
                console.log(this.post);
                let config = {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                };
                axios
                    .post(
                        `/api/article/update/${this.post.id}`,
                        this.post,
                        config
                    )
                    .then(res => {
                        alert("Update suceess");
                        setTimeout(() => {
                            window.location;
                        }, 2500);
                    })
                    .catch(err => console.log(err));
            } else {
                alert("Unauthorised");
            }
        },
        setImg() {
            const img = this.$refs.image.files[0];
            this.createBase64(img);
        },
        createBase64(img) {
            const reader = new FileReader();
            reader.onload = e => {
                this.post.img = e.target.result;
            };
            reader.readAsDataURL(img);
        }
    }
};
</script>
