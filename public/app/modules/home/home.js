(function () {
    'use strict';

    angular.module('app.home', [])
        .config(configure)

        .controller('HomeCtrl.main', HomeCtrl_main)
    ;

    configure.$inject = ['$stateProvider'];

    function configure($stateProvider) {
        $stateProvider
            .state('app', {
                url: '/',
                abstract: true,
                views: {
                    '': {
                        templateUrl: '/app/modules/layout.html'
                    }
                }
            })
            .state('app.main', {
                url: '',
                views: {
                    content: {
                        controller: 'HomeCtrl.main',
                        templateUrl: '/app/modules/home/main.html'
                    }
                }
            });
    }

    HomeCtrl_main.$inject = [];

    function HomeCtrl_main() {

    }

})();



