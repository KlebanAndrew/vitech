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
            .state('messages', {
                abstract: true,
                url: '/',
                views: {
                    '': {
                        templateUrl: '/app/modules/layout.html'
                    }
                }
            })
            .state('messages.list', {
                url: '?type',
                views: {
                    content: {
                        controller: 'MessagesCtrl.main as ctrl',
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
            })
            .state('messages.create', {
                url: '',
                views: {
                    content: {
                        controller: 'MessagesCtrl.create as ctrl',
                        templateUrl: '/app/modules/messages/create.html'
                    }
                },
                resolve: {

                }
            });
    }

})();