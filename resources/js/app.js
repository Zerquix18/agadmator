import Vue from 'vue';
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';
import Main from './components/Main.vue';

Vue.use(Buefy, {
  defaultIconPack: 'fas',
  defaultContainerElement: '#app',
});

new Vue({
  el: "#app",
  render: (h) => {
    return h(Main);
  }
});
