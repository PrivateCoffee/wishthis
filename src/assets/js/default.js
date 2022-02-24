/**
 * Service Worker
 */
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
    navigator.serviceWorker
        .register('/serviceWorker.js')
        .then(res => console.log('service worker registered'))
        .catch(err => console.log('service worker not registered', err))
    })
}


const urlParams = new URLSearchParams(window.location.search);

$(function() {
    /**
     * Fomantic UI
     */
    $.fn.api.settings.api = {
        'get wishlists'        : '/src/api/wishlists.php',
        'delete wishlist'      : '/src/api/wishlists.php',
        'update product status': '/src/api/products.php',
        'delete product'       : '/src/api/products.php',
    };

    /** Default callbacks */
    $.fn.api.settings.onResponse = function(response) {
        return response;
    }
    $.fn.api.settings.successTest = function(response) {
        return response.status == 'OK' || response.success || false;
    }
    $.fn.api.settings.onComplete = function(response, element, xhr) {
        element.removeClass('loading');
    }
    $.fn.api.settings.onSuccess = function(response, element, xhr) {
        element.dropdown({
            values: response.results,
            placeholder: 'No wishlist selected.'
        })

        if (urlParams.has('wishlist')) {
            element.dropdown('set selected', urlParams.get('wishlist'));
        } else {
            if (response.results[0]) {
                element.dropdown('set selected', response.results[0].value);
            }
        }
    }
    $.fn.api.settings.onFailure = function(response, element, xhr) {
        console.log(response);
        console.log(element);
        console.log(xhr);

        if ('string' === typeof response) {
            response = response.replace('<br />', '');
        }

        $('body')
        .modal({
            title:    'Failure',
            content:  response,
            class:    '',
            actions:  [
                {
                    text: 'Thanks for nothing',
                    class: 'primary'
                }
            ]
        })
        .modal('show');
    }
    $.fn.api.settings.onError = function(response, element, xhr) {
        console.log(response);
        console.log(element);
        console.log(xhr);

        if ('string' === typeof response) {
            response = response.replace('<br />', '');
        }

        $('body')
        .modal({
            title:    'Error',
            content:  response,
            class:    '',
            actions:  [
                {
                    text: 'Thanks for nothing',
                    class: 'primary'
                }
            ]
        })
        .modal('show');
    }
    /** */
});
