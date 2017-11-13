(function () {
    'use strict';

    angular
        .module('app.messages', [//todo maybe rename to messages
            // 'app.home.components'
        ])
        .config(configure);

    configure.$inject = ['$stateProvider'];

    function configure($stateProvider) {
        $stateProvider
            .state('app', {
                abstract: true,
                url: '/',
                views: {
                    '': {
                        templateUrl: '/app/modules/layout.html'
                    }
                }
            })
            .state('app.main', {//todo maybe rename to app.messages
                url: '?type',
                views: {
                    content: {
                        controller: 'HomeCtrl.main as ctrl',
                        templateUrl: '/app/modules/messages/main.html'
                    }
                },
                resolve: {
                    items: [
                        'MessagesService', '$stateParams',
                        function (MessagesService, $stateParams) {
                            return MessagesService.getMessagesList($stateParams.type || 'received');
                        }
                    ]
                }
            });
    }

})();