<template>
    <div class="container">
        <h1>Insert page</h1>

        Title: <input type="text" v-model="post.title" /> Body:
        <input type="text" v-model="post.body" /> Image:
        <input type="file" id="file" ref="img" v-on:change="setImg()" />
        <button @click="insertArticle">Insert</button>
    </div>
</template>
<script>
import axios from "axios";
import { isAuthenticated, fetchCookie } from "../../helpers";
export default {
    name: "Insert",
    data() {
        return {
            post: {
                title: "",
                img: "",
                body: ""
            }
        };
    },
    methods: {
        insertArticle() {
            if (isAuthenticated) {
                let token = fetchCookie();
                if (token.length > 0) {
                    console.log(this.post);
                    let config = {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    };
                    axios
                        .post("/api/article/create", this.post, config)
                        .then(res => alert(res.data.message))
                        .catch(err => console.log(err));
                } else {
                    window.location.href = "/";
                }
            } else {
                window.location.href = "/";
            }
        },
        setImg() {
            const img = this.$refs.img.files[0];
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
