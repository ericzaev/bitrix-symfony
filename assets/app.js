import './styles/app.scss';

import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue);

const context = require.context('./widget');

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[is]').forEach(item => {
    try {
      const component = context(`./${item.getAttribute('is')}.vue`).default;

      if (_.isObject(component)) {
        new Vue({el: item, render: h => h(component, {props: Object.assign({}, __parseProps(item.dataset || {}))})});
      }
    } catch (error) {}
  });
});

/**
 * @param data - {'id': 'int:2', 'list': 'array:[1, 2, 3]'}
 */
function __parseProps(data) {
  const result = {};

  for (const prop in data) {
    if (data.hasOwnProperty(prop)) {
      let value = data[prop];
      const parts = value.match(/^(\w+):(.+)/);

      if (!!parts) {
        switch (parts[1]) {
          case 'int':
            value = parseInt(parts[2]);

            break;
          case 'float':
            value = parseFloat(parts[2]);

            break;
          case 'array':
          case 'object':
            value = JSON.parse(parts[2]);

            break;
        }
      }

      result[prop] = value;
    }
  }

  return result;
}