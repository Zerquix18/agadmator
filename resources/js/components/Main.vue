<template>
<div class="main-form">
  <div>
    <h2 class="title">Search</h2>
  </div>
  <form method="POST" style="margin-top: 25px">
    <div class="columns">
      <b-field class="column is-one-quarter">
        <b-input placeholder="White pieces"
            type="text"
            icon="chess-pawn">
        </b-input>
      </b-field>
      <b-field class="column is-one-quarter">
        <b-input placeholder="Black Pieces"
            type="text"
            icon="chess-pawn">
        </b-input>
      </b-field>
      <b-field class="column is-one-quarter">
        <b-input placeholder="Opening"
            type="text"
            icon="chess-board">
        </b-input>
      </b-field>
      <b-field class="column is-one-quarter">
        <b-input placeholder="Event"
            type="text"
            icon="trophy">
        </b-input>
      </b-field>
    </div>
    <div class="columns">
      <b-field class="column is-one-quarter">
        <b-input placeholder="Game name"
            type="text"
            icon="chess">
        </b-input>
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
  data: () => {
    return {
      results: [],
      loading: false,
      message: 'Fill at least one field and click Search!'
    };
  },
}
</script>
