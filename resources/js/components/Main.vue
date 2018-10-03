<template>
<div class="main-form">
  <div>
    <h2 class="title">Search</h2>
  </div>
  <form method="POST" style="margin-top: 25px">
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
  </form>
  <hr>
  <div class="result-message">
    <span>{{ message }}</span>
  </div>
</div>
</template>

<script>
export default {
  data: function () {
    return {
      autocomplete: {
        available: {},
        selected: {},
        isLoading: false,
      },
      results: [],
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
          return response.json();
      })
      .then((result) => {
        console.log(result);
        this.autocomplete.available[option] = result[which];
      })
      .finally(() => {
        this.autocomplete.isLoading = false;
      });
    }
  }
}
</script>
