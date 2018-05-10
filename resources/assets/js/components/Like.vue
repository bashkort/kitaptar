<template>
  <span>
    <a href="#" v-if="isLiked" @click.prevent="unLike(book)">
      <i class="fa fa-heart"></i>
    </a>
    <a href="#" v-else @click.prevent="like(book)">
    <i  class="fa fa-heart-o"></i>
    </a>
  </span>
</template>

<script>
  export default {
    props: ['book', 'liked'],

    data: function() {
      return {
        isLiked: '',
      }
    },

    mounted() {
      this.isLiked = this.isLike ? true : false;
    },

    computed: {
      isLike() {
        return this.liked;
      },
    },

    methods: {
      like(book) {
        axios.post('/like/' + book)
          .then(response => this.isLiked = true);
      },
      unLike(book) {
        axios.post('/unlike/' + book)
          .then(response => this.isLiked = false);
      }
    }
  }
</script>
