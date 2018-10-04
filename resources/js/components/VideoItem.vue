<template>
<div class="column is-one-third">
  <div class="card">
    <div class="card-image">
      <figure class="video-container">
        <embed :src="`https://www.youtube.com/embed/${video.id}`" alt="Placeholder image">
      </figure>
    </div>
    <div class="card-content">
      <div class="media">
        <div class="media-content">
          <p class="title is-4">{{ video.white_pieces }} vs {{ video.black_pieces }}</p>
          <p v-if="video.game_name" class="subtitle is-6">{{ video.game_name }}</p>
          <p class="subtitle is-6">{{ video.event }}</p>
          <p class="subtitle is-6">{{ video.opening }}</p>
        </div>
      </div>
      <div class="content">
        <time>Uploaded on {{ video.video_date }}</time>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['video'],
}
</script>
