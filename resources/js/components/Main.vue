<template>
<div class="main-form">
  <div>
    <h2 class="title">Search</h2>
  </div>
  <form class="main-form" id="main-form">
    <div class="columns is-multiline">
      <FilterInput placeholder="White Pieces" icon="chess-pawn"  field="white_pieces" />
      <FilterInput placeholder="Black Pieces" icon="chess-pawn"  field="black_pieces" />
      <FilterInput placeholder="Opening"      icon="chess-board" field="opening" />
      <FilterInput placeholder="Event"        icon="trophy"      field="event" />
      <FilterInput placeholder="Game name"    icon="chess"       field="game_name" />
    </div>
    <div class="has-text-right">
      <input type="submit" class="button is-primary is-medium" v-on:click="search">
    </div>
  </form>
  <hr>
  <div v-if="result.length === 0" class="result-message">
    <span>{{ message }}</span>
  </div>
  <div v-else>
    <div class="columns is-multiline">
      <VideoItem v-for="video in result" v-bind:key="video.id" :video="video" />
    </div>
  </div>
</div>
</template>

<script>

import VideoItem from './VideoItem.vue';
import FilterInput from './FilterInput.vue';

export default {

  components: {VideoItem, FilterInput},

  data: function () {
    return {
      result: [],
      message: 'Fill at least one field and click Search!'
    };
  },

  methods: {
    search: function (e) {
      e.preventDefault();

      let fields = [
        'white_pieces',
        'black_pieces',
        'opening',
        'event',
        'game_name',
      ];

      let data = {};
      
      for (const field of fields) {
        data[field] = document.getElementById(field).value;
      }

      const qs = Object.entries(data)
                 .map(pair => pair.map(encodeURIComponent).join('='))
                 .join('&');

      fetch(window.searchUrl + '?' + qs)
      .then((response) => {
        if (response.ok) {
          return response.json();
        }
      }).then((result) => {
        if (! result) {
          return;
        }
        this.result = result.videos;
        if (this.result.length === 0) {
          this.message = 'No videos found. Please try with a different criteria';
        }
      }).catch((error) => {
        this.message = 'There was a problem while getting the results. Please try again';
      });
    }
  }
}
</script>
