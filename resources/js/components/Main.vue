<template>
<div class="main-form">
  <div>
    <h2 class="title">Search</h2>
  </div>
  <form style="margin-top: 25px" id="main-form">
    <div class="columns">
      <b-field class="column is-one-quarter">
        <b-autocomplete
            v-model="autocomplete.selected.whitePieces"
            placeholder="White pieces"
            type="text"
            :data="autocomplete.available.whitePieces"
            :loading="autocomplete.isLoading"
            @input="() => getData('white_pieces')"
            @select="option => autocomplete.selected.whitePieces = option"
            icon="chess-pawn">
        </b-autocomplete>
      </b-field>
      <b-field class="column is-one-quarter">
        <b-autocomplete
            v-model="autocomplete.selected.blackPieces"
            placeholder="Black pieces"
            type="text"
            :data="autocomplete.available.blackPieces"
            :loading="autocomplete.isLoading"
            @input="() => getData('black_pieces')"
            @select="option => autocomplete.selected.blackPieces = option"
            icon="chess-pawn">
        </b-autocomplete>
      </b-field>
      <b-field class="column is-one-quarter">
        <b-autocomplete
            v-model="autocomplete.selected.opening"
            placeholder="Opening"
            type="text"
            :data="autocomplete.available.opening"
            :loading="autocomplete.isLoading"
            @input="() => getData('opening')"
            @select="option => autocomplete.selected.opening = option"
            icon="chess-board">
        </b-autocomplete>
      </b-field>
      <b-field class="column is-one-quarter">
        <b-autocomplete
            v-model="autocomplete.selected.event"
            placeholder="Event"
            type="text"
            :data="autocomplete.available.event"
            :loading="autocomplete.isLoading"
            @input="() => getData('event')"
            @select="option => autocomplete.selected.event = option"
            icon="trophy">
        </b-autocomplete>
      </b-field>
    </div>
    <div class="columns">
      <b-field class="column is-one-quarter">
        <b-autocomplete
            placeholder="Game name"
            type="text"
            :data="autocomplete.available.game_name"
            :loading="autocomplete.isLoading"
            @input="() => getData('game_name')"
            @select="option => autocomplete.selected.game_name = option"
            icon="chess">
        </b-autocomplete>
      </b-field>
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

export default {
  components: {VideoItem},
  data: function () {
    return {
      autocomplete: {
        available: {},
        selected: {},
        isLoading: false,
      },
      result: [],
      isLoading: false,
      message: 'Fill at least one field and click Search!'
    };
  },
  methods: {
    getData: function (which) {
      const toCamelCase = {
        white_pieces: 'whitePieces',
        black_pieces: 'blackPieces',
        opening: 'opening',
        event: 'event',
        game_name: 'gameName',
      };
      const option = toCamelCase[which];
      const value  = this.autocomplete.selected[option];

      this.autocomplete.available[option] = [];
      this.autocomplete.isLoading         = true;

      fetch(window.completeUrl + '?' + which + '=' + value)
      .then((response) => {
        if (response.ok) {
          return response.json();
        }
        return null;
      })
      .then((result) => {
        if (result) {
          this.autocomplete.available[option] = result[which];
        }
      })
      .finally(() => {
        this.autocomplete.isLoading = false;
      });
    },

    search: function (e) {
      e.preventDefault();
      const snakeCase = {
        whitePieces: 'white_pieces',
        blackPieces: 'black_pieces',
        gameName: 'game_name'
      };

      const fields = {};
      
      for (const field in this.autocomplete.selected) {
        if (field in snakeCase) {
          fields[snakeCase[field]] = this.autocomplete.selected[field];
        } else {
          fields[field] = this.autocomplete.selected[field];
        }
      }

      const qs = Object.entries(fields)
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
