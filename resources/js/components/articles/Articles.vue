<template>
  <div class="container">
    <h1>Articles page</h1>
    <div class="row">
      <div v-for="(post, index) in posts" v-bind:key="index" class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" :src="post.img" alt />

          <div class="card-body">
            <h4 class="card-title">
              <a href="#">{{post.title}}</a>
            </h4>
            <h5>Published by: {{post.user.name}}</h5>
            <p
              class="card-text"
            >{{post.body.lenght>150?post.body.substr(0, 150-1) + "..." : post.body}}</p>
          </div>
          <div class="card-footer">
            <button v-on:click="deletePost(post.id, index)">Delete</button>
            <button>Edit</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <button @click="paginate(prevPage)">Previus</button>
      <button @click="paginate(nextPage)">Next</button>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { fetchCookie } from "../../helpers";
export default {
  name: "Articles",
  data() {
    return {
      posts: [],
      nextPage: "",
      prevPage: "",
      url: "/api/",
    };
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      axios
        .get(this.url)
        .then((res) => {
          this.posts = res.data.data;
          this.nextPage = res.data.next_page_url;
          this.prevPage = res.data.prev_page_url;
        })
        .catch((err) => console.log(err));
    },
    paginate(url) {
      this.url = url;
      this.getPosts();
    },
    deletePost(id, index) {
      let token = fetchCookie();
      if (token.length > 0) {
        let config = {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        };
        axios
          .post(`/api/article/delete/${id}`, config)
          .then((res) => {
            this.posts.splice(index, 1);
          })
          .catch((err) => console.log(err));
      } else {
        alert("Unauthorised");
      }
    },
  },
};
</script>
