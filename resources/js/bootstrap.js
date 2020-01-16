window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

document.addEventListener('DOMContentLoaded', function() {
    const formatPostcode = () => {
        const input = document.getElementById('postcode');
        const postcode = document.getElementById('postcode').value;

        if (postcode.match(/^\d{2}$/) !== null) {
            input.value = postcode + '.';
        } else if (postcode.match(/^\d{2}\.\d{3}$/) !== null) {
            input.value = postcode + '-';
        }
    };

    if (document.getElementById('postcode')) {
        document.getElementById('postcode').addEventListener('keyup', formatPostcode);
    }

    const formatPrice = () => {
        const input = document.getElementById('price');
        const price = document.getElementById('price').value.replace(/\D/g, '');

        while (price.legth < 3) {
            price = "0" + price
        }

        const value = price.slice(0, -2);
        const decimals = price.slice(-2);

        input.value = Number(value).toLocaleString('pt-BR') + ',' + decimals;
    };

    if (document.getElementById('price')) {
        document.getElementById('price').addEventListener('keyup', formatPrice);
    }
});