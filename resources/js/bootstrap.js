import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const bearerToken = '9|K3ACKeOKGZFvoHfuRuEbDNL6wiaBScmeZYY78d99ae41a30f';

axios.get('/api/user', {
  headers: {
    Authorization: `Bearer ${bearerToken}`,
  }
})
.then(response => {
  const userId = response.data.id;

  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: 'mt1',
    forceTLS: false,
    disableStats: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
      headers: {
        Authorization: `Bearer ${bearerToken}`
      }
    }
  });

  window.Echo.private(`tasks.${userId}`)
    .listen('.realTask.created', (e) => {
      console.log('New Task:', e);
      alert(`New Task Created: ${e.task_id} Title: ${e.title})`);
    });
})
.catch(error => {
  console.error('User not authenticated', error);
});
